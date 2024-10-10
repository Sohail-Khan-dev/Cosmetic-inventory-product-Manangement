<?php

namespace App\Livewire\Table;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseTable extends Component
{
    use WithPagination;
    protected $listeners = ['expenseAdded'];
    public $perPage=5;

    public Expense $currentExpene;

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
    public function deleteingRecord($id)
    {
        dump('delete function called :livewire');

    }
    public function expenseAdded()
    {
        // Re-render the component when the expense is added
//        $this->dispatchBrowserEvent('notify', ['message' => 'Expense added successfully!']);
        $this->render(); // Or just $this->reset(), if necessary
    }
//    public function delete($id) : void
//    {
//        dump($this->currentExpene , " This is delete function" , $id);
//        $done = Expense::find($id)->delete();
//        if($done)
//            $this->render();
//    }
    public function render()
    {
        $expenses = Expense::latest()->paginate($this->perPage);
        return view('livewire.table.expense-table',[
            'expenses' => $expenses
        ]);
    }
}
