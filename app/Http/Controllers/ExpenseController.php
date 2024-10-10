<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('expense.index',[
            'expenses' => Expense::latest()->paginate(10),
            'update_expense'=>''
        ]);
    }

//    /**
//     * Show the form for creating a new resource.
//     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());

        $rules=[
          'exp_name'=>'required',
          'exp_description'=>'string',
//          'exp_purpose'=>'required',
//          'exp_payment_mode'=>'required', Rule::in(['cash', 'cheque']),
          'exp_amount'=>'required',
//          'exp_status'=>'required',Rule::in(['paid', 'due']),
        ];


//        dd($request->all());




        $validatedData = $request->validate($rules);
        if($request->id != null) {
            $expense = Expense::find($request->id);
            $expense->update($validatedData);
            return response()->json(['success'=>true]);
        }
        if(Expense::Create($validatedData))
            return redirect()->json(['success'=>true]);
        return redirect()->json(['success'=>false]);
    }

    /**
     * Display the specified resource.
     */
//    public function show(Expense $expense)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        dd($request->all());
        return view('expense.expense_form',[
            'exp' => $expense,
        ]);
//
//        return view('expense.index',[
//            'expenses' => Expense::all(),
//            'update_expense'=>$expense
//        ]);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
//        $rules=[
//            'exp_name'=>'required',
//            'exp_description'=>'string',
////            'exp_purpose'=>'required',
////            'exp_payment_mode'=>'required', Rule::in(['cash', 'cheque']),
//            'exp_amount'=>'required',
////            'exp_status'=>'required',Rule::in(['paid', 'due']),
//        ];
//        $validatedData = $request->validate($rules);

        $done=$expense->save();

        if($done)
            return redirect()->route('expense.index')->with('success','Expense updated successfully');
        return redirect()->route('expense.index')->with('error','Something Went Wrong');


    }
    public function getExpenceForm(Request $request)
    {
        return view('expense.expense_form');
//        dd($form);
//        return response()->json(['form'=>$form]);
    }
    public function getExpenceId($id)
    {
        $exp = Expense::find($id);
//        dd($id , $exp);

        return view('expense.add-edit',[
            'exp' => $exp,
        ]);
//        dd($form);
//        return response()->json(['form'=>$form]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        if($expense->delete())
            return redirect()->route('expense.index')->with('success','Expense deleted successfully');

        return redirect()->route('expense.index')->with('error','Something Went Wrong');
    }

    public function deleteRecord(Request $request)
    {
        $id = $request->input('id');
        Expense::destroy($id);
        return response()->json(['success' => true, 'message' => 'Record deleted.']);
    }

}
