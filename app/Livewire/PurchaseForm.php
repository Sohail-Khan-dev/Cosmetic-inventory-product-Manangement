<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PurchaseForm extends Component
{
    #[Validate('Required')]
    public int $taxes = 0;
    public $product_name ;
    public array $invoiceProducts = [];

    #[Validate('required', message: 'Please select products')]
    public Collection $allProducts;
    public $product_buying_price = 0 ;
    public function mount(): void
    {
        $this->allProducts = Product::where("user_id",auth()->id())->get();
    }

    public function render(): View
    {
        $total = 0;
        foreach ($this->invoiceProducts as $invoiceProduct)
        {
            if ($invoiceProduct['is_saved'] && $invoiceProduct['product_price'] && $invoiceProduct['quantity'])
            {
                $total += $invoiceProduct['product_price'] * $invoiceProduct['quantity'];
            }
        }

        return view('livewire.purchase-form', [
            'subtotal' => $total,
            'total' => $total * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100)
        ]);
    }

    public function addProduct(): void
    {
        foreach ($this->invoiceProducts as $key => $invoiceProduct)
        {
            if (!$invoiceProduct['is_saved'])
            {
                $this->addError('invoiceProducts.' . $key, 'This line must be saved before creating a new one.');
                return;
            }
        }

        $this->invoiceProducts[] = [
            'product_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'product_name' => '',
            'product_price' => 0
        ];
    }

    public function editProduct($index): void
    {
        foreach ($this->invoiceProducts as $key => $invoiceProduct)
        {
            if (! $invoiceProduct['is_saved'])
            {
                $this->addError('invoiceProducts.' . $key, 'This line must be saved before editing another.');
                return;
            }
        }

        $this->invoiceProducts[$index]['is_saved'] = false;
    }

    public function saveProduct($index): void
    {
        $this->resetErrorBag();
        // dump("Add product is Called", $this->invoiceProducts[$index]['product_id'], $this->product );

         // Validate that the buying price is greater than zero
        if ($this->product_buying_price <= 0) {
            $this->addError('invoiceProducts.'.$index . 'buying_price', "The buying price must be greater than zero.");
            return;
        }
        if($this->invoiceProducts[$index]['quantity'] <= 0 ){
            $this->addError('invoiceProducts.'.$index . 'quantity', "The quantity must be greater than zero.");
            return;
        }
        $val = $this->invoiceProducts[$index]['product_id'] ; // === "add_new"  ? $this->selectedProductId   : $this->invoiceProducts[$index]['product_id'];
        if($val === "add_new"){
            // dump("$ " , $this->product->id);
            $this->invoiceProducts[$index]['product_id'] = $this->product->id;
        }
        // dump( $this->invoiceProducts[$index]['product_id']);

        $product = $this->allProducts->find($this->invoiceProducts[$index]['product_id']); // == "add_new" ? $this->selectedProductId : $this->product->id);
        $this->invoiceProducts[$index]['product_name'] = $product->name;
        $this->invoiceProducts[$index]['product_price'] = $this->product_buying_price;
        $product->buying_price = $this->product_buying_price;  // This price will be set to the product itself. and above will be on the carts .
        $product->save();
        $this->invoiceProducts[$index]['is_saved'] = true;
        $this->product_buying_price = 0 ;
    }

    public function removeProduct($index): void
    {
        unset($this->invoiceProducts[$index]);

        $this->invoiceProducts = array_values($this->invoiceProducts);
    }
    public $selectedProduct;
    public function handleProductChange()
    {
        if ($this->selectedProduct === 'add_new') {
            $this->selectedProduct = '';
            $this->dispatch('openModal');
        }
    }
    public function saveNewProduct(){
        // Validate the product name
        // $this->validate([
        //     'productName' => 'required|string|max:255',
        // ]);
        // dd($this->product_name);
        if(empty($this->product_name)){
            // dd("Product name is Empty ");
            $this->addError('product_name', 'Product name should not be empty ');
            return;
        }
        $product =  Product::create([
            "code" => IdGenerator::generate([
                'table' => 'products',
                'field' => 'code',
                'length' => 4,
                'prefix' => 'PC'
            ]),
            'name'              => $this->product_name,
            "user_id" => auth()->id(),
            "slug" => Str::slug($this->product_name, '-'),
            "uuid" => Str::uuid()
        ]);
        if($product){
            $this->dispatch('closeModal',['productId' => $product->id]);
            $this->product = $product;
            $this->allProducts = Product::where("user_id",auth()->id())->get();
        }
    }
    public $product = null;
}
