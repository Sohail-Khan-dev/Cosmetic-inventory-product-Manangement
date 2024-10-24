<div class="container-xl">
    <div class="row row-cards">
        <div class="row">
            <!-- <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            {!! __('Product Image') !!}
                        </h3>
                        <img style="width: 90px;" id="image-preview"
                            src="{!! $product['product_image'] ? asset('storage/' . $product['product_image']) : asset('assets/img/products/default.webp') !!}"
                            alt="" class="img-account-profile mb-2">
                    </div>
                </div>
            </div> -->
            <div class="">
                <div class="card">
                    <!-- <div class="card-header">
                        <h3 class="card-title">
                            {!! __('Product Details') !!}
                        </h3>
                    </div> -->
                    <div class="table-responsive">
                        <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{!! $product['name'] !!}</td>
                                </tr>
                                <tr>
                                    <td>Slug</td>
                                    <td>{!! $product['slug'] !!}</td>
                                </tr>
                                <tr>
                                    <td><span class="text-secondary">Code</span></td>
                                    <td>{!! $product['code'] !!}</td>
                                </tr>
                                <tr>
                                    <td>Barcode</td>
                                    <td>{!! $barcode !!}</td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td>
                                        <a href="#"
                                            class="badge bg-blue-lt">
                                            {!! $product['category']->name ?? "No Category" !!}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Unit</td>
                                    <td>
                                        <a href="#"
                                            class="badge bg-blue-lt">
                                            {!! $product['unit']->short_code ?? "No Unit " !!}
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Quantity</td>
                                    <td>{!! $product['quantity'] !!}</td>
                                </tr>
                                <tr>
                                    <td>Quantity Alert</td>
                                    <td>
                                        <span class="badge bg-red-lt">
                                            {!! $product['quantity_alert'] ?? 0 !!}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Buying Price</td>
                                    <td>Khan lala </td>
                                </tr>
                                <tr>
                                    <td>Selling Price</td>
                                    <td>Gul Lala </td>
                                </tr>
                                <tr>
                                    <td>Tax</td>
                                    <td>
                                        <span class="badge bg-red-lt">
                                            {!! $product['tax'] ?? 0 !!} %
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tax Type</td>
                                    <td>{!! @$product['tax_type']->label ?? "Tax type" !!}</td>
                                </tr>
                                <tr>
                                    <td>{!! __('Notes') !!}</td>
                                    <td>{!! $product['notes'] ?? " No Note " !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="card-footer text-end">
                        <a class="btn btn-info" href="{!! url()->previous() !!}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l14 0" />
                                <path d="M5 12l6 6" />
                                <path d="M5 12l6 -6" />
                            </svg>
                            {!! __('Back') !!}
                        </a>
                        <a class="btn btn-warning" href="{!! route('products.edit', $product['id']) !!}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                <path d="M13.5 6.5l4 4" />
                            </svg>
                            {!! __('Edit') !!}
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

