<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class PosController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['category', 'unit'])->get();

        $customers = Customer::all()->sortBy('name');

        // $carts = Cart::content();
        // Remove the cats as it will be loaded from Javascript. getCart Function is written below
        return view('pos.index', [
            'products' => $products,
            'customers' => $customers,
            // 'carts' => $carts,
        ]);
    }

    public function addCartItem (Request $request)
    {
        // $request->all();
        // dd($request->all());

        $rules = [
            'id' => 'required|numeric',
            'name' => 'required|string',
            'selling_price' => 'required|numeric',
        ];

        $validatedData = $request->validate($rules);

       $productAddedToCart =  Cart::add(
            $validatedData['id'],
            $validatedData['name'],
            1,
            $validatedData['selling_price'],
            1,
            (array)$options = null
        );
        return response()->json(['success',true, "productAdded"=>$productAddedToCart,'message'=>'Product has been added to cart!']);
        // return redirect()
        //     ->back()
        //     ->with('success', 'Product has been added to cart!');
    }

    public function updateCartItem(Request $request)
    {
        // dd($request->all());
        $rowId = $request->rowId;
        $rules = [
            'qty' => 'required|numeric',
            'product_id' => 'numeric'
        ];
        
        $validatedData = $request->validate($rules);
        if ($validatedData['qty'] > Product::where('id', intval($validatedData['product_id']))->value('quantity')) {
            return response()->json(['success'=>false,'message'=>'The requested quantity is not available in stock.']);
                // above line is added as we will update this with Javascript 
            // return redirect()
            // ->back()
            // ->with('error', 'The requested quantity is not available in stock.');
        }
        

        Cart::update($rowId, $validatedData['qty']);
        return response()->json(['success'=>true, 'message'=>'Product has been updated from cart!']);
        // above line is added as we will update this with Javascript 
        // return redirect()
        //     ->back()
        //     ->with('success', 'Product has been updated from cart!');
    }

    public function deleteCartItem(Request $request) //  String $rowId)
    {
        // dd($request->all());
        $rowId = $request->rowId;
       $result =  Cart::remove($rowId);
        return response()->json(['success'=>true, "result"=>$result, 'message'=>'Product has been deleted from cart!']); 

        return redirect()
            ->back()
            ->with('success', 'Product has been deleted from cart!');
    }
    // This function will return the view of Tbody along with total, count etc of Table .
    public function getCart() {
        $carts = Cart::content();
        return view('orders.cart-items',compact('carts'));
    }
}
