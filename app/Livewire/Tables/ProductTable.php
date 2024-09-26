<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class ProductTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'id';

    public $sortAsc = false;


    public $showModal = false;
    public function sortBy($field): void
    {
        if($this->sortField === $field)
        {
            $this->sortAsc = ! $this->sortAsc;

        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }
    public function deleteProduct($product_id){
        $product = Product::find($product_id);
        /**
         * Delete photo if exists.
         */
        if ($product->product_image) {
            if (file_exists(public_path('storage/') . $product->product_image)) {
                unlink(public_path('storage/') . $product->product_image);
            }
        }
        $product->delete();
    }
    public function viewProduct($product){
       $this->dispatch('openModal',$product,"product/show");

    }

    public function render()
    {
        return view('livewire.tables.product-table', [
            'products' => Product::where("user_id",auth()->id())
                ->with(['category', 'unit'])
                ->search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
        ]);
    }
}
