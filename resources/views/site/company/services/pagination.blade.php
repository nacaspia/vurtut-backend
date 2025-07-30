<div class="mbp_pagination mt10">
    <ul class="page_navigation">
        {{-- Previous link --}}
        <li class="page-item {{ $companyServices->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $companyServices->previousPageUrl() ?? '#' }}" tabindex="-1">
                <span class="fa fa-angle-left"></span>
            </a>
        </li>

        @for ($i = 1; $i <= $companyServices->lastPage(); $i++)
            @if ($i == $companyServices->currentPage())
                <li class="page-item active"><a class="page-link" href="#">{{ $i }}</a></li>
            @elseif ($i <= 3 || $i > $companyServices->lastPage() - 2 || abs($i - $companyServices->currentPage()) <= 1)
                <li class="page-item"><a class="page-link" href="{{ $companyServices->url($i) }}">{{ $i }}</a></li>
            @elseif ($i == 4 || $i == $companyServices->lastPage() - 3)
                <li class="page-item"><a class="page-link" href="#">...</a></li>
            @endif
        @endfor

        {{-- Next link --}}
        <li class="page-item {{ $companyServices->hasMorePages() ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $companyServices->nextPageUrl() ?? '#' }}">
                <span class="fa fa-angle-right"></span>
            </a>
        </li>
    </ul>
</div>
