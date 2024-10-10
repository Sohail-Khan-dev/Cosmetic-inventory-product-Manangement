<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Purchase;
use Illuminate\Http\Request;

class CalculateTotalProfit extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        return view('expense.index',[
            'expenses' => Expense::all(),
            'purchases' => Purchase::all(),
            'update_expense'=>''
        ]);

    }

    public function show(){

    }

}
