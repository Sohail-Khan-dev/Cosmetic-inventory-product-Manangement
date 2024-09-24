<?php

namespace App\Http\Controllers\Order;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderCompleteController extends Controller
{
    public function __invoke(Request $request)
    {
        $orders = Order::where('order_status', OrderStatus::COMPLETE)
            ->latest()
            ->with('customer')
            ->get();
        $total_amount = $orders->sum('total');
        $total_pay = $orders->sum('pay');
        $total_due = $orders->sum("due");
        return view('orders.complete-orders', [
            'orders' => $orders,
            'total_amount' => $total_amount,
            'total_pay' => $total_pay,
            'total_due' => $total_due
        ]);
    }
}
