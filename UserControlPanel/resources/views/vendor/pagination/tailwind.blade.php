<nav aria-label="Page navigation example">
    <ul class="flex items-center -space-x-px h-10 text-base">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg cursor-not-allowed" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li aria-disabled="true"><span class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 cursor-not-allowed">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li aria-current="page"><span class="z-10 flex items-center justify-center px-4 h-10 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100">{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 cursor-not-allowed rounded-e-lg" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
</nav>
