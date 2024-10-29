<?php

namespace App\Http\Controllers\Dashboards;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::where("user_id", auth()->id())->count();
        $products = Product::where("user_id", auth()->id())->count();

        $purchases = Purchase::where("user_id", auth()->id())->count();
        $todayPurchases = Purchase::whereDate('date', today()->format('Y-m-d'))->count();
        $todayProducts = Product::whereDate('created_at', today()->format('Y-m-d'))->count();
        $todayQuotations = Quotation::whereDate('created_at', today()->format('Y-m-d'))->count();
        $todayOrders = Order::whereDate('created_at', today()->format('Y-m-d'))->count();

        $categories = Category::where("user_id", auth()->id())->count();
        $quotations = Quotation::where("user_id", auth()->id())->count();

        return view('dashboard', [
            'products' => $products,
            'orders' => $orders,
            'purchases' => $purchases,
            'todayPurchases' => $todayPurchases,
            'todayProducts' => $todayProducts,
            'todayQuotations' => $todayQuotations,
            'todayOrders' => $todayOrders,
            'categories' => $categories,
            'quotations' => $quotations
        ]);
    }
    public function getSaleReport(Request $request){
        $query = Order::where('user_id', auth()->id())->where('created_at','>=', Carbon::now()->subDays($request->range))->get();
        $total = $query->sum('total');
        $due = $query->sum("due");
        $received = $query->sum('pay');

       return response()->json(['total'=>$total, 'due'=>$due , 'received'=>$received]);
    }

    public function getPurchaseReport(Request $request){
        $query = Purchase::where('user_id', auth()->id())->where('created_at','>=', Carbon::now()->subDays($request->range))->get();
        $total = $query->sum("total_amount"); 
        $pending =Purchase::where('user_id', auth()->id())->where('status', 0)->sum("total_amount");
        $approve = Purchase::where('user_id', auth()->id())->where('status', 1)->sum('total_amount');
       return response()->json(['total'=> $total, 'approve'=>$approve , 'pending'=> $pending]);
    }
    public function getExpenseReport(Request $request){
        $total = Expense::all()->where('created_at','>=', Carbon::now()->subDays($request->range))->sum('exp_amount');
        return response()->json(['total'=>$total]);
    }
}
