@if ($paginator->hasPages())
    <div class="flex justify-between items-center mt-4">
        {{-- Previous Page Link --}}
        <div>
            @if ($paginator->onFirstPage())
                <span class="disabled text-gray-400">Previous dogs</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded transition duration-200">Previous</a>
            @endif
        </div>

        <div class="flex space-x-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="text-gray-400">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="bg-blue-600 text-white px-3 py-1 rounded">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="text-white bg-blue-500 hover:bg-blue-700 px-3 py-1 rounded transition duration-200">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        <div>
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded transition duration-200">Next</a>
            @else
                <span class="disabled text-gray-400">Next</span>
            @endif
        </div>
    </div>
@endif
