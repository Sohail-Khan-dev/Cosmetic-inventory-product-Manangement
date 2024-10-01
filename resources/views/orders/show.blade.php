@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">
                            {{ __('Order Details') }}
                        </h3>
                    </div>

                    <div class="card-actions btn-actions">
                        @if ($order->order_status === \App\Enums\OrderStatus::PENDING)
                            <div class="dropdown">
                                <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"><!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                    </svg>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <form action="{{ route('orders.update', $order->uuid) }}" method="POST">
                                        @csrf
                                        @method('put')

                                        <button type="submit" class="dropdown-item text-success"
                                            onclick="return confirm('Are you sure you want to approve this order?')">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-check" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M5 12l5 5l10 -10" />
                                            </svg>

                                            {{ __('Approve Order') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                        
                        <x-action.close route="{{ route('orders.index') }}" />
                    </div>
                </div>

                <div class="card-body">
                    <div class="row row-cards mb-3">
                        <div class="col">
                            <label for="order_date" class="form-label required">
                                {{ __('Order Date') }}
                            </label>
                            <input type="text" id="order_date" class="form-control"
                                value="{{ $order->order_date->format('d-m-Y') }}" disabled>
                        </div>

                        <div class="col">
                            <label for="invoice_no" class="form-label required">
                                {{ __('Invoice No.') }}
                            </label>
                            <input type="text" id="invoice_no" class="form-control" value="{{ $order->invoice_no }}"
                                disabled>
                        </div>

                        <div class="col">
                            <label for="customer" class="form-label required">
                                {{ __('Customer') }}
                            </label>
                            <input type="text" id="customer" class="form-control" value="{{ $order->customer->name }}"
                                disabled>
                        </div>

                        <div class="col">
                            <label for="payment_type" class="form-label required">
                                {{ __('Payment Type') }}
                            </label>

                            <input type="text" id="payment_type" class="form-control" value="{{ $order->payment_type }}"
                                disabled>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="align-middle text-center">No.</th>
                                    <!-- <th scope="col" class="align-middle text-center">Photo</th> -->
                                    <th scope="col" class="align-middle text-center">Product Name</th>
                                    <th scope="col" class="align-middle text-center">Product Code</th>
                                    <th scope="col" class="align-middle text-center">Quantity</th>
                                    <th scope="col" class="align-middle text-center">Price</th>
                                    <th scope="col" class="align-middle text-center">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->details as $item)
                                    <tr>
                                        <td class="align-middle text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <!-- <td class="align-middle text-center">
                                            <div style="max-height: 80px; max-width: 80px;">
                                                <img class="img-fluid"
                                                    src="{{ $item->product->product_image ? asset('storage/' . $item->product->product_image) : asset('assets/img/products/default.webp') }}">
                                            </div>
                                        </td> -->
                                        <td class="align-middle text-center">
                                            {{ $item->product->name }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $item->product->code }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $item->unitcost }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $item->total }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-end">
                                        Payed amount
                                    </td>
                                    <td class="text-center">{{ $order->pay }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end">Due</td>
                                    <td class="text-center">{{ $order->due }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end">VAT</td>
                                    <td class="text-center">{{ $order->vat }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end">Total</td>
                                    <td class="text-center">{{ $order->total }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end">Status</td>
                                    <td class="text-center">
                                        <x-status dot
                                            color="{{ $order->order_status === \App\Enums\OrderStatus::COMPLETE ? 'green' : ($order->order_status === \App\Enums\OrderStatus::PENDING ? 'orange' : '') }}"
                                            class="text-uppercase">
                                            {{ $order->order_status->label() }}
                                        </x-status>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end">Pay Now</td>
                                    <td class="text-center"><input type="number" name='pay' class="pay-input" value="{{$order->due }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-end">
                    @if ($order->order_status === \App\Enums\OrderStatus::PENDING)
                        <form action="{{ route('orders.update', $order->uuid) }}" method="POST">
                            @method('put')
                            @csrf
                            <input type="hidden" name="pay" id="pay" value="">
                            <button type="submit" class="btn btn-primary"
                               
                                >
                                {{ __('Pay Order') }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@push('page-scripts')
    <script>
        setTimeout(() => {
            console.log("{{$order->due}}");
            let value = "{{$order->due}}";
            setValueToPay(value);            
        }, 1000);
        $(document).on('input', '.pay-input', function() {
            const newValue = $(this).val();
            setValueToPay(newValue);
        });
        function setValueToPay(value){
            console.log("Value is Changed " , value);
            $('#pay').val(value);
        }
    </script>
@endpush
 
