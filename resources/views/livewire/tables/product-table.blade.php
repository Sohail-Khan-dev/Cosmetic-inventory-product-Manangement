<div>
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">
                    {{ __('Products') }}
                </h3>
            </div>

            <div class="card-actions btn-group">
            <a href="{{ route('products.create') }}" class="btn btn-icon btn-outline-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
            </a>
                <div class="dropdown">
                    <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <x-icon.vertical-dots />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" style="">
                        <a href="{{ route('products.create') }}" class="dropdown-item">
                            <x-icon.plus />
                            {{ __('Create Product') }}
                        </a>
                        <a href="{{ route('products.import.view') }}" class="dropdown-item">
                            <x-icon.plus />
                            {{ __('Import Products') }}
                        </a>
                        <a href="{{ route('products.export.store') }}" class="dropdown-item">
                            <x-icon.plus />
                            {{ __('Export Products') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="text-secondary">
                    Show
                    <div class="mx-2 d-inline-block">
                        <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                    entries
                </div>
                <div class="ms-auto text-secondary">
                    Search:
                    <div class="ms-2 d-inline-block">
                        <input type="text" wire:model.live="search" class="form-control form-control-sm"
                            aria-label="Search invoice">
                    </div>
                </div>
                <button class="d-none" id="refresh-product" wire:click="$refresh">Refresh</button>
                <input type="hidden" wire:click>
            </div>
        </div>

        <x-spinner.loading-spinner />

        <div class="table-responsive">
            <table wire:loading.remove class="table table-bordered card-table table-vcenter text-nowrap datatable">
                <thead class="thead-light">
                    <tr>
                        <th class="align-middle text-center w-1">
                            {{ __('No.') }}
                        </th>
                        <!-- <th scope="col" class="align-middle text-center">
                            {{ __('Image') }}
                        </th> -->
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('name')" href="#" role="button">
                                {{ __('Name') }}
                                @include('inclues._sort-icon', ['field' => 'name'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('code')" href="#" role="button">
                                {{ __('Code') }}
                                @include('inclues._sort-icon', ['field' => 'code'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('category_id')" href="#" role="button">
                                {{ __('Category') }}
                                @include('inclues._sort-icon', ['field' => 'category_id'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('quantity')" href="#" role="button">
                                {{ __('Quantity') }}
                                @include('inclues._sort-icon', ['field' => 'quantity'])
                            </a>
                        </th>
{{--                        <th scope="col" class="align-middle text-center">--}}
{{--                                {{ __('Buying Price') }}--}}
{{--                        </th>--}}
{{--                        <th scope="col" class="align-middle text-center">--}}
{{--                                {{ __('Selling Price') }}--}}
{{--                        </th>--}}
                        <th scope="col" class="align-middle text-center">
                            {{ __('Action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="align-middle text-center">
                                {{ $loop->iteration }}
                            </td>
                            <!-- <td class="align-middle text-center">
                                <img style="width: 90px;"
                                    src="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('assets/img/products/default.webp') }}"
                                    alt="">
                            </td> -->
                            <td class="align-middle text-center">
                                {{ $product->name }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $product->code }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $product->category ? $product->category->name : '--' }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $product->quantity }}
                            </td>
{{--                            <td class="align-middle text-center">--}}
{{--                                {{ $product->buying_price }}--}}
{{--                            </td>--}}
{{--                            <td class="align-middle text-center">--}}
{{--                                {{ $product->selling_price }}--}}
{{--                            </td>--}}
                            <td class="align-middle text-center" style="width: 10%">

                                <x-button type="button" class="btn-icon btn btn-outline-info view-product" id="view-product" data-page="product/show" data-product="{{$product}} ">  <x-icon.eye/> </x-button>
                                <x-button type="button" class="btn-icon btn btn-outline-warning edit-product" data-page="product/edit" id="edit-product" data-product="{{$product}}" >  <x-icon.pencil/> </x-button>
                                <x-button type="button" class="btn-icon btn btn-outline-danger" wire:click="deleteProduct({{$product->id}})" ><x-icon.trash/> </x-button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="align-middle text-center" colspan="7">
                                No results found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-secondary">
                Showing <span>{{ $products->firstItem() }}</span>
                to <span>{{ $products->lastItem() }}</span> of <span>{{ $products->total() }}</span> entries
            </p>

            <ul class="pagination m-0 ms-auto">
                {{ $products->links() }}
            </ul>
        </div>
    </div>
</div>
@script('scripts')
<script>

    //  $wire.on('openModal', (product,pageToInclude) => {
    $(document).on('click', ".edit-product" , function(e){
        e.preventDefault();
        let product = $(this).data('product');
        let page_url = $(this).data('page');
        let page_title = "Edit Product";
        setAndShowModal(product,page_url,page_title);
    });
    $(document).on('click', ".view-product" , function(e){
        e.preventDefault();
        let product = $(this).data('product');
        let page_url = $(this).data('page');
        let page_title = "Product Detail";
        setAndShowModal(product,page_url,page_title);
    });
    function setAndShowModal(product,page_url,page_title){
        $.ajax({
            url :page_url,
            method: 'get',
            data :{
                'product' : product,
            },
            beforeSend: function(){
                $("#loadingModal").modal('show');
            },
            success: function(response){
                $("#loadingModal").modal('hide');
                // console.log( " Response is : " , response);
                document.getElementById('modalContent').innerHTML = response.product;
                $("#modalTitle").text(page_title);
                $("#modal-save-btn").hide();
                $("#productModal").modal('show');
            }
        });
    }
    $(document).on('submit','#update-product' , function(e){
        console.log("Update button is clicked");
        e.preventDefault();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var formData = new FormData(this); // Get the form data
        formData.append('_token', csrfToken);
        // formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // Add CSRF token to the form data
        $.ajax({
            url: 'product/update', // The URL to send the request to
            type: 'post', // The request type
            data: formData, // The form data
            processData: false, // Important for file uploads
            contentType: false, // Important for file uploads
            beforeSend: function(){
                $("#loadingModal").modal('show');
            },
            success: function(response) {
                $("#loadingModal").modal('hide');
                console.log('Product updated successfully!');
                $('#refresh-product').click();
                $("#productModal").modal('hide');
            },
            error: function(xhr, status, error) {
                // Handle the error response
                console.log('Error updating the product: ' + error);
            }
        });

    });
</script>
@endscript
