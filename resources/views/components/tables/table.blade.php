@props([
    'items' => [], // Collection of data
    'columns' => [], // Column headers ['key' => 'Label']
    'paginate' => 'paginate', // Livewire pagination model
    'searchQuery' => 'searchQuery', // Livewire search model
    'showActions' => false, // Show actions column
    'actionView' => null, // Path to action buttons view
    'formatters' => [], // Associative array of column formatters
])

<div class="card">
    <div class="card-body py-3">
        <div class="d-flex">
            <!-- Pagination Control -->
            <div class="text-secondary d-flex align-items-center">
                <label for="paginateSelect" class="me-2">Show</label>
                <select id="paginateSelect" class="form-select form-select-sm w-auto" wire:model.live="paginate">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span class="d-none d-md-inline-block ms-2">entries</span>
            </div>

            <!-- Search Input -->
            <div class="ms-auto text-secondary">
                Search:
                <div class="ms-2 d-inline-block">
                    <input type="search" wire:model.live="searchQuery" class="form-control form-control-sm"
                        aria-label="Search">
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    @foreach ($columns as $key => $label)
                        <th>{{ $label }}</th>
                    @endforeach
                    @if ($showActions)
                        <th class="text-center">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td class="w-1">{{ $items->firstItem() + $loop->index }}</td>
                        @foreach ($columns as $key => $column)
                            <td>
                                @if (isset($formatters[$key]) && is_callable($formatters[$key]))
                                    @php
                                        $formatted = $formatters[$key]($item);
                                    @endphp

                                    @if ($formatted instanceof \Illuminate\View\View || $formatted instanceof \Illuminate\Contracts\Support\Renderable)
                                        {!! $formatted->render() !!}
                                    @else
                                        {{ $formatted }}
                                    @endif
                                @else
                                    {{ data_get($item, $key, '---') }}
                                @endif
                            </td>
                        @endforeach
                        @if ($showActions)
                            <td class="text-center">
                                @if ($actionView)
                                    @include($actionView, ['item' => $item])
                                @endif
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) + ($showActions ? 2 : 1) }}" class="text-center">No
                            records found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if ($items->hasPages())
        <div class="card-footer border-0">
            {{ $items->onEachSide(1)->links() }}
        </div>
    @endif
</div>
