@if ($paginator->hasPages())
    <div class="pagination">
        <ul>
            @if ($paginator->onFirstPage())
                <li class="btn--white prev disable">
                    <span><i class="fas fa-angle-left"></i></span>
                </li>
            @else
                <li class="btn--white prev">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-angle-left"></i>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="btn--white btn--active">
                            <span>{{ $page }}</span>
                        </li>
                    @else
                        <li class="btn--white"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="btn--white next">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
            @else
                <li class="btn--white next disable">
                    <span><i class="fas fa-angle-right"></i></span>
                </li>
            @endif
        </ul>
    </div>
@endif
