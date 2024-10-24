
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
                        <form wire:submit.prevent="createOrUpdate" id='add-edit-form'>
                            @csrf
                            <input type="hidden" name="id" id='id' value="" wire:model="id">
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row row-cards">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            {{ __('Expence Type  ')  }}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="exp_name"  wire:model="exp_name" required
                                                                class="form-select  @error('name') is-invalid @enderror">
                                                                <option value="" selected="" disabled="">Select an Expence</option>
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
                                                        <label class="form-label">
                                                            Enter Amount
                                                        </label>
                                                         <input type="number"  name="exp_amount" wire:model='exp_amount' required
                                                            class="form-control @error('amount') is-invalid @enderror"
                                                            min="0" value=""
                                                            placeholder="0" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3 mb-0">
                                                        <label  class="form-label">
                                                            Enter Description
                                                        </label>

                                                        <textarea name="exp_description" rows="5" class="form-control @error('description') is-invalid @enderror"
                                                                wire:model="exp_description"  placeholder="Description"></textarea>

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
@script
<script>
    $wire.on('closeModal', () => {
        console.log("Close Modal ");
        $('#add-edit-expence').modal('hide');
    });
    $wire.on('showModal',()=>{
        $('#add-edit-expence').modal('show');
    });
    $('.add-new-expence').on('click', function() {
        $('#add-edit-expence').find('form')[0].reset();
    });
</script>
@endscript
