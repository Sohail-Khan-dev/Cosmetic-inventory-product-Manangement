<?php

namespace App\Livewire\Tables;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $perPage=5;

    public $id;
    public $exp_name;
    public $exp_description;
    public $exp_amount;


    protected $rules = [
        'exp_name' => 'required',
        'exp_description' => 'nullable|string',
        'exp_amount' => 'required|numeric',
    ];
    public function deleteRecord($id)
    {
        $record = Expense::find($id);
        if ($record) {
            $record->delete();
            session()->flash('message', 'Record deleted successfully.');
        } else {
            session()->flash('error', 'Record not found.');
        }
    }
    public function mount(){
        $this->reset();
    }

    public function createOrUpdate(){
        $validatedData = $this->validate();
        $expense = Expense::find($this->id);
        if($this->id != null && $expense) {
            $expense->update($validatedData);
            $this->dispatch('closeModal');
            return response()->json(['success'=>true]);
        }
        if(Expense::Create($validatedData))
            {
                $this->dispatch('closeModal');
                return response()->json(['success'=>true]);
            }
        $this->resetForm();

      return response()->json(['success'=>false]);
   }
    public function editRecord($id){
        $expense = Expense::find($id);
        $this->id = $expense->id;
        $this->exp_name = $expense->exp_name;
        $this->exp_description = $expense->exp_description;
        $this->exp_amount = $expense->exp_amount;
        // dump($expense);
        $this->dispatch('showModal');
    }
    public function render()
    {
        $expenses = Expense::latest()
            ->search($this->search)
            ->paginate($this->perPage);
        return view('livewire.tables.expense-table',[
            'expenses' => $expenses
        ]);
    }
}
