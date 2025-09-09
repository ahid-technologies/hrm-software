<div class="row">
    <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
        <p class="m-0 visible text-secondary">
            @if ($paginator->total() > 0)
                Showing {{ $paginator->firstItem() }} to
                {{ $paginator->lastItem() }}
                of
                {{ $paginator->total() }} entries
            @else
                No entries found
            @endif
        </p>
    </div>
    <div class="col-md-6 d-flex justify-content-center justify-content-md-end">
        <ul class="pagination mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link cursor-pointer" tabindex="-1" aria-disabled="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M15 6l-6 6l6 6"></path>
                        </svg>
                        @lang('pagination.previous')
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link cursor-pointer" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                        wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M15 6l-6 6l6 6"></path>
                        </svg>
                        @lang('pagination.previous')
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link cursor-pointer">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span
                                    class="page-link cursor-pointer">{{ $page }}</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link cursor-pointer"
                                    wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link cursor-pointer" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        wire:loading.attr="disabled">
                        @lang('pagination.next')
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 6l6 6l-6 6"></path>
                        </svg>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link cursor-pointer" aria-disabled="true">
                        @lang('pagination.next')
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 6l6 6l-6 6"></path>
                        </svg>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
