@if(!empty($companyPersons[0]) && $companyPersons->lastPage()!=1)
<div class="mbp_pagination mt10">
    <ul class="page_navigation">
        {{-- Previous link --}}
        <li class="page-item {{ $companyPersons->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $companyPersons->previousPageUrl() ?? '#' }}" tabindex="-1">
                <span class="fa fa-angle-left"></span>
            </a>
        </li>
        @for ($i = 1; $i <= $companyPersons->lastPage(); $i++)
            @if ($i == $companyPersons->currentPage())
                <li class="page-item active"><a class="page-link" href="#">{{ $i }}</a></li>
            @elseif ($i <= 3 || $i > $companyPersons->lastPage() - 2 || abs($i - $companyPersons->currentPage()) <= 1)
                <li class="page-item"><a class="page-link" href="{{ $companyPersons->url($i) }}">{{ $i }}</a></li>
            @elseif ($i == 4 || $i == $companyPersons->lastPage() - 3)
                <li class="page-item"><a class="page-link" href="#">...</a></li>
            @endif
        @endfor
        {{-- Next link --}}
        <li class="page-item {{ $companyPersons->hasMorePages() ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $companyPersons->nextPageUrl() ?? '#' }}">
                <span class="fa fa-angle-right"></span>
            </a>
        </li>
    </ul>
</div>
@endif
