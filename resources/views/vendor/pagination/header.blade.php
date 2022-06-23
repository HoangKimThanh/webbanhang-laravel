<div class="filter-footer">
    <span class="page">
        <span class="highlight">{{ $paginator->currentPage() }}</span> /
        <span class="total">{{ $paginator->lastPage() }}</span>
    </span>
    @if ($paginator->onFirstPage())
        <span class="filter-btn-left btn btn--white btn--disable">
            <i class="fas fa-angle-left"></i>
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="filter-btn-left btn btn--white">
            <i class="fas fa-angle-left"></i>
        </a>
    @endif

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="filter-btn-right btn btn--white">
            <i class="fas fa-angle-right"></i>
        </a>
    @else
        <span class="filter-btn-right btn btn--white btn--disable">
            <i class="fas fa-angle-right"></i>
        </span>
    @endif

</div>
