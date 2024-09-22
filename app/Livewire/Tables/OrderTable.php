<?php

namespace App\Livewire\Tables;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'invoice_no';

    public $sortAsc = false;

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

    public function render()
    {
        $orders_query = Order::where("user_id",auth()->id())
            ->with(['customer', 'details'])
            ->search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        $total_amount = $orders_query->sum('total');
        $total_pay = $orders_query->sum('pay');
        $total_due = $orders_query->sum("due");

        return view('livewire.tables.order-table', [
            'orders' => $orders_query                
                ->paginate($this->perPage),
                'total_amount' => $total_amount,
                'total_pay' => $total_pay,
                'total_due' => $total_due
        ]);
    }
}
