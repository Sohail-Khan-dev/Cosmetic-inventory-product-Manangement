@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <!-- Below div is for the alert to show here  -->
        <div id="alert-container" class="d-none"> this is alert </div>
        <div class="row row-cards">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">
                                {{ __('New Order') }}
                            </h3>
                        </div>
                        <div class="card-actions btn-actions">
                            <x-action.close route="{{ route('orders.index') }}"/>
                        </div>
                    </div>
                    <form action="{{ route('invoice.create') }}" method="POST" id="order-form">
                    @csrf
                        <div class="card-body">
                            <div class="row gx-3 mb-3">
                                @include('partials.session')
                                <div class="col-md-4">
                                    <label for="purchase_date" class="small my-1">
                                        {{ __('Date') }}
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input name="purchase_date" id="purchase_date" type="date"
                                           class="form-control example-date-input @error('purchase_date') is-invalid @enderror"
                                           value="{{ old('purchase_date') ?? now()->format('Y-m-d') }}"
                                           required
                                    >

                                    @error('purchase_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="small mb-1" for="customer_id">
                                        {{ __('Customer') }}
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select form-control-solid @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" id="customer-select">
                                        <option selected="" disabled="">
                                            Select a customer:
                                        </option>

                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" @selected( old('customer_id') == $customer->id)>
                                                {{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('customer_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="small mb-1" for="reference">
                                        {{ __('Reference') }}
                                    </label>

                                    <input type="text" class="form-control"
                                           id="reference"
                                           name="reference"
                                           value="ORD"
                                           readonly
                                    >

                                    @error('reference')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered align-middle">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">{{ __('Product') }}</th>
                                            <th scope="col" class="text-center">{{ __('Quantity') }}</th>
                                            <th scope="col" class="text-center">{{ __('Price') }}</th>
                                            <th scope="col" class="text-center">{{ __('SubTotal') }}</th>
                                            <th scope="col" class="text-center">
                                                {{ __('Action') }}
                                            </th>
                                        </tr>
                                    </thead>
                                  <tbody id="cartItemTbody">

                                  </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success add-list mx-1 {{ Cart::count() > 0 ? '' : 'disabled' }}">
                                {{ __('Create Invoice') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-lg-5">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">
                        List Product
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered align-middle"  id="productTable" >
                                    <thead class="thead-light">
                                        <tr>
                                            {{--- <th scope="col">No.</th> ---}}
                                            <th scope="col">Name</th>
                                            <th scope="col">Quantity</th>
                                            {{-- <th scope="col">Unit</th> --}}
                                            <th scope="col">Price</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                        <tr>
                                            {{---
                                            <td>
                                                <div style="max-height: 80px; max-width: 80px;">
                                                    <img class="img-fluid"  src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/img/products/default.webp') }}">
                                                </div>
                                            </td>
                                            ---}}
                                            <td class="text-center">
                                                {{ $product->name }}
                                            </td>
                                            <td class="text-center">
                                                {{ $product->quantity }}
                                            </td>
                                            {{-- <td class="text-center">
                                                {{ $product->unit->name }}
                                            </td> --}}
                                            <td class="text-center">
                                                {{ number_format($product->buying_price, 2) }}
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <form id="addCartItemForm">
                                                    <!-- <form action="{{ route('pos.addCartItem', $product) }}" method="POST"> -->
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                                        <input type="hidden" name="name" value="{{ $product->name }}">
                                                        <input type="hidden" name="buying_price" value="{{ $product->buying_price }}">
                                                        <button type="submit" class="btn btn-icon btn-outline-primary">
                                                            <x-icon.cart/>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <th colspan="6" class="text-center" >
                                                Data not found!
                                            </th>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@pushonce('page-scripts')
    <script>
        $(document).ready(function(){
            getCart("");  // This will get the cart at page loading .

            if({{ $total_products}} > 0){
                $('#productTable').DataTable({
                    "paging": true,        // Enable pagination
                    "searching": true,     // Enable search bar
                    "ordering": true,      // Enable column-based sorting
                    "responsive": true     // Make the table responsive
                });
            }
            $(document).on("submit", "#addCartItemForm", function(e){
                e.preventDefault();
                console.log("Button is clided of Add items ");
                let formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('pos.addCartItem') }}",
                    method : 'post',
                    data : formData,
                    beforeSend: function(){
                        $("#loadingModal").modal("show");
                    },
                    success : function(response){
                        $("#loadingModal").modal("hide");
                        getCart(response.message);
                        $(".add-list").removeClass('disabled')
                    },
                    error: function(xhr,status,error){
                        console.log("Error Occured : " + error);
                    }
                });
            });

            // For updatting the Quanity of the Cart itemd
            $(document).on("click", ".updateButton", function(e){
                console.log("clicked on Update Quantity form ");

                e.preventDefault();
                let form = $(this).closest('form');
                let formData = form.serialize();
                $.ajax({
                    url: "{{ route('pos.updateCartItem') }}",
                    method : 'post',
                    data : formData,
                    beforeSend:function(){
                        $("#loadingModal").modal("show");
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token if needed
                    },
                    success : function(response){
                        $("#loadingModal").modal("hide");
                        getCart(response.message);
                        if(!response.success)
                            alert("There is no more stock of this Item");
                    },
                    error: function(xhr,status,error){
                        console.log("Error Occured : " + error);
                    }
                });
            });
            $(document).on('click', ".deleteCartItem" , function(e){
                e.preventDefault();
                let form = $(this).closest('form');
                let formData = form.serialize();
                $.ajax({
                    url: "{{ route('pos.deleteCartItem') }}",
                    method: 'delete',
                    data : formData,
                    beforeSend: function(){
                        $("#loadingModal").modal("show");
                    },
                    success : function(response){
                        $("#loadingModal").modal("hide");
                        if(response.success)
                            getCart(response.message);
                        else
                            alert('There is something Wrong Cannot delete it');
                    },
                    error : function(xhr, status, error){
                        console.log("Error is : " , error);

                    }
                });
            });
            $('#order-form').submit(function(e){
                console.log("order fomr is submitted ");
               let customerSelect = $("#customer-select").val();
                if(!customerSelect.val()){
                    e.preventDefault();
                    alert("please select Customer First ");
                }
            });
            function getCart(message){
                console.log("this is get card ");
                $.ajax({
                    url: "{{route('pos.cartItem')}}",
                    method : 'get',
                    beforeSend:function(){
                        $("#loadingModal").modal("show");
                    },
                    success: function(response){
                        $("#loadingModal").modal("hide");
                        $('#cartItemTbody').html(response);
                        // console.log(response);

                        if(message != "" || message != undefined)
                            successAlert(message);
                    },
                    error:function(xhr, status,error){
                        $("#loadingModal").modal("hide");
                        console.log("Error is : " + error);
                    }
                });
            }
            function successAlert(message){
                // console.log("success " + message);
                let successComponent  =  $('#alert-container');
                var alertHtml = `
                <div class="alert alert-success alert-dismissible" role="alert">
                    <h3 class="mb-1">Success</h3>
                    <p>${message}</p>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>`;

                successComponent.html(alertHtml);
                successComponent.removeClass('d-none');
                setTimeout(() => {
                   successComponent.addClass('d-none');
                }, 3000);
            }
        });
    </script>
@endpushonce
