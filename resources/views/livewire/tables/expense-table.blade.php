<div>
    <style>
        .description-td {
            max-width: 400px;
            /* Set a fixed width for the td */
            white-space: nowrap;
            /* Prevent text from wrapping */
            overflow: hidden;
            /* Hide overflowed text */
            text-overflow: ellipsis;
            /* Show ellipsis (...) for overflowed text */
            cursor: pointer;
            /* Change cursor to indicate the cell is interactive */
            transition: all 0.3s ease;
            /* Smooth transition for hover */
        }

        .description-td:hover {
            white-space: normal;
            /* Allow text to wrap */
            max-width: 500px;
            /* Optionally expand the width on hover */
            overflow: visible;
            /* Show the full text */
            word-wrap: break-word;
            /* Break long words if necessary */
            background-color: #f9f9f9;
            /* Optional: Change background on hover */
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
            /* Optional: Add shadow for better visibility */
        }
    </style>

    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ 'Expences' }}
                    </h3>
                </div>

                <div class="card-actions">
                    <button class="btn btn-primary add-new-expence" data-bs-toggle="modal" data-bs-target="#add-edit-expence"> Add new
                    </button>
                </div>
            </div>

            <div class="card-body border-bottom py-3">
                <div class="d-flex">
                    <div class="text-secondary">
                        Show
                        <div class="mx-2 d-inline-block">
                            <select wire:model.live="perPage" class="form-select form-select-sm"
                                aria-label="result per page">
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
                            <th scope="col" class="align-middle text-center">
                                <a wire:click.prevent="sortBy('invoice_no')" href="#" role="button">
                                    {{ __('Expence Type') }}
                                    {{--                        @include('inclues._sort-icon', ['field' => 'invoice_no']) --}}
                                </a>
                            </th>
                            <th scope="col" class="align-middle text-center">
                                <a wire:click.prevent="sortBy('customer_id')" href="#" role="button">
                                    {{ __('Description') }}
                                    {{--                        @include('inclues._sort-icon', ['field' => 'customer_id']) --}}
                                </a>
                            </th>
                            <th scope="col" class="align-middle text-center">
                                <a wire:click.prevent="sortBy('order_date')" href="#" role="button">
                                    {{ __('Amount') }}
                                    {{--                        @include('inclues._sort-icon', ['field' => 'order_date']) --}}
                                </a>
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($expenses as $expence)
                            <tr>
                                <td class="align-middle text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="align-middle text-center">
                                    {{ $expence->exp_name }}
                                </td>
                                <td class="align-middle text-center description-td">
                                    {{ $expence->exp_description }}
                                </td>
                                <td class="align-middle text-center">
                                    {{ $expence->exp_amount }}
                                </td>
                                <td class="align-middle text-center">

                                    <button type="button" class="btn-icon btn btn-outline-info edit-btn" wire:click.prevent="editRecord({{$expence->id}})" wire:loading.attr="disabled"> <x-icon.pencil /></button>
                                    <button type="button" class="btn-icon btn btn-outline-danger"wire:click.prevent="deleteRecord({{ $expence->id }})" wire:loading.attr="disabled"> <x-icon.trash /></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="align-middle text-center" colspan="8">
                                    No results found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">
                    Showing <span>{{ $expenses->firstItem() }}</span> to <span>{{ $expenses->lastItem() }}</span> of
                    <span>{{ $expenses->total() }}</span> entries
                </p>

                <ul class="pagination m-0 ms-auto">
                    {{ $expenses->links() }}

                </ul>
            </div>
        </div>
    </div>
    @include('expense.add-edit');

</div>
