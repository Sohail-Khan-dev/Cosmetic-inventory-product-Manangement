@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if (!$products)
            <x-empty title="No products found" message="Try adjusting your search or filter to find what you're looking for."
                button_label="{{ __('Add your first Product') }}" button_route="{{ route('products.create') }}" />

            <div style="text-center" style="padding-top:-25px">
                <center>
                    <a href="{{ route('products.import.view') }}" class="">
                        {{ __('Import Products') }}
                    </a>
                </center>
            </div>
        @else
            <div class="container-xl">
                <x-alert />
                @livewire('tables.product-table')
            </div>
            <!-- Modal -->
            <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:none">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title w-100" id="modalTitle" style="text-align: center;">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div id="modalContent"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="modal-save-btn">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
