<style>
 input,label{
     margin:5px;
 }
</style>
<form id="add-edit-expence">
{{--    action="{{ route('expense.store') }}" method="post">--}}
    @csrf
    @dump($exp)
    <div class="mb-3">
        <label for="bill" >Choose an Expense:</label>

        <select id="bill" name="exp_name" required>
            <option value="Shop Rent">Shop Rent</option>
            <option value="Daily Lunch">Daily Lunch</option>
            <option value="Electricity Bill">Electricity Bill</option>
            <option value="Gas Bill">Gas Bill</option>
            <option value="Worker Wage">Worker Wage</option>
            <option value="Dinner">Dinner</option>
        </select>

        <label for="exampleFormControlInput1" class="form-label">Purpose of Expense</label>
        <input type="text" class="form-control" name="exp_purpose" id="exampleFormControlInput1" placeholder="Purpose">

        <label for="exampleFormControlInput1" class="form-label">Enter Description</label>
        <textarea class="form-control" name="exp_description" id="exampleFormControlInput1" placeholder="Description" rows="6"></textarea>

        <label for="exampleFormControlTextarea1" class="form-label">Payment Mode</label>
        <input type="radio" id="html" name="exp_payment_mode" value="cash">
        <label for="html">Cash</label><br>
        <input type="radio" id="css" name="exp_payment_mode" value="cheque">
        <label for="css">Cheque</label><br>

        <label for="amountofEpx" class="form-label">Enter Amount</label>
        <input type="number" class="form-control" min="10" name="exp_amount" id="amountofEpx" placeholder="50.00 PKR">

        <label for="expe_status" >Expense Status:</label>

        <select id="expe_status" name="exp_status" required>
            <option value="due">Payment Due</option>
            <option value="paid">Expense Paid</option>
        </select>
    </div>
    <div class="text-center">
        <button class="btn btn-primary" type="submit">Create Expense</button>
    </div>
</form>
