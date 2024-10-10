
<div class="modal fade" id="add-edit-expence" tabindex="-1" aria-labelledby="add-editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-1 text-center w-100" id="add-edit-title">Add Expense</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="add-edit-body">
                <div class="container-xl">
                    <div class="row row-cards">
                        <form id="Add-Expense" >
                            @csrf
{{--                            @method('PATCH')--}}
                            <input type="hidden" name="id" id="exp_id" value="">
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row row-cards">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="expencetype" class="form-label">
                                                            {{ __('Expence Type  ')  }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="exp_name" id="expencetype"
                                                                class="form-select @error('expencetype') is-invalid @enderror">
                                                                <option selected="" disabled="">Select an Expence</option>
                                                                <option value="shop_rent">Shop Rent</option>
                                                                <option value="lunch">Daily Lunch</option>
                                                                <option value="electricity_bill">Electricity Bill</option>
                                                                <option value="gas_bill" >gas_bill</option>
                                                                <option value="worder_wage">Worker Wage</option>
                                                                <option value="Labour_cost">Labour cost</option>
                                                                <option value="extra">Extra</option>
                                                        </select>
                                                        @error('expencetype')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="exp_amount" class="form-label">
                                                            Enter Amount
                                                        </label>
                                                         <input type="number" id="exp_amount" name="exp_amount"
                                                            class="form-control"
                                                            min="0" value=""
                                                            placeholder="0" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3 mb-0">
                                                        <label for="notes" class="form-label">
                                                            Enter Description
                                                        </label>

                                                        <textarea name="exp_description" id="notes" rows="5" class="form-control @error('notes') is-invalid @enderror"
                                                                  placeholder="Description"></textarea>

                                                        @error('notes')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>`
                                            </div>
                                        </div>

                                        <div class="card-footer text-end">
                                            <button class="btn btn-primary" type="submit"> Add </button>
                                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('page-scripts')
    <script>
        $(document).ready(function () {
            $('#Add-Expense').submit(function (e) {
                console.log('form submitted');
                e.preventDefault();

                $.ajax({
                    url: '{{route('expense.store')}}',
                    type: 'post',
                    data: new FormData(this),
                    processData: false, // Prevent jQuery from automatically processing the data
                    contentType: false, // Tell jQuery not to set content type header
                    success: function (response) {
                        console.log('form submission succeeded', response);
                        $("#add-edit-expence").modal('hide');
                        Livewire.dispatch('expenseAdded');

                    },
                    error: function (xhr, status, error) {
                        console.log('form submission failed');
                        console.log(xhr.responseText); // Log error details
                    }
                });
            });
        });

    </script>


@endpush
