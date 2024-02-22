@php
    // decide the next 2 pages!
    $startPages = '';
    $nextPages = '';
    if ($paginator->currentPage()+2 <= $paginator->lastPage()) {

        $startPages = $paginator->currentPage();
        $nextPages = $paginator->currentPage()+2;
    }
    else if ($paginator->currentPage() == $paginator->lastPage()) {
        $startPages = ($paginator->currentPage()-2 > 0)? $paginator->currentPage()-2 : 1;
        $nextPages = $paginator->currentPage();
    } else {
        $startPages = ($paginator->currentPage()-1 > 0)? $paginator->currentPage()-1 : 1;
        $nextPages = $paginator->lastPage();
    }
@endphp
<!--Begin::Pagination-->
<div class="row">
    <div class="col-xl-12">
        <!--begin:: Components/Pagination/Default-->
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <!--begin: Pagination-->
                <div class="my-work" style="display: flex">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                    <a class="page-link" href="{{ $paginator->url(1) . (Request::get('perPage') ? "&perPage=".Request::get('perPage') : "")}}" aria-label="Previous">

                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                            </li>
                            <li class="page-item" @empty($paginator->previousPageUrl()) hidden @endempty>
                                    <a class="page-link" href="{{ $paginator->previousPageUrl() . (Request::get('perPage') ? "&perPage=".Request::get('perPage') : "")}}" aria-label="Previous">

                                        <span aria-hidden="true">{{$custom[strtolower('last')]??"last"}}</span>
                                    </a>
                            </li>
                            @for ($i = $startPages; $i <= $nextPages; $i++)
                                <li class="@if ($paginator->currentPage() == $i) page-item active @else page-item @endif">
                                    <a class="page-link" href="{{ $paginator->url($i) . (Request::get('perPage') ? "&perPage=".Request::get('perPage') : "")}}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item" @empty($paginator->nextPageUrl()) hidden @endempty>
                                    <a class="page-link"  href="{{ $paginator->nextPageUrl() . (Request::get('perPage') ? "&perPage=".Request::get('perPage') : "")}}" aria-label="Next">
                                        <span aria-hidden="true">{{$custom[strtolower('next')]??"next"}} </span>
                                    </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) . (Request::get('perPage') ? "&perPage=".Request::get('perPage') : "")}}"
                                   aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="kt-pagination__toolbar ml-auto" style="display: flex">
                        <select class="form-control kt-font-brand per-page-select" style="width: 80px"
                                onchange="setPerPage();">
                            <option value="10" @if((isset($perPage) && $perPage == 10 )|| (Request::get('perPage') && Request::get('perPage') == 10 )) selected @endif>10</option>
                            <option value="20" @if((isset($perPage) && $perPage == 20 )|| (Request::get('perPage') && Request::get('perPage') == 20 )) selected @endif>20</option>
                            <option value="30" @if((isset($perPage) && $perPage == 30 )|| (Request::get('perPage') && Request::get('perPage') == 30 )) selected @endif>30</option>
                            <option value="50" @if((isset($perPage) && $perPage == 50 )|| (Request::get('perPage') && Request::get('perPage') == 50 )) selected @endif>50</option>
                            <option value="100" @if((isset($perPage) && $perPage == 100 )|| (Request::get('perPage') && Request::get('perPage') == 100 )) selected @endif>100</option>
                        </select>
                        <span class="pagination__desc">
                        {{$custom[strtolower('Displaying')]??"Displaying"}} {{ $paginator->count() }} {{$custom[strtolower('of')]??"of"}}  {{ $paginator->total() }} {{$custom[strtolower('records')]??"records"}}
                    </span>
                    </div>
                </div>
                <!--end: Pagination-->
            </div>
        </div>
        <!--end:: Components/Pagination/Default-->
    </div>
</div>

<!--End::Pagination-->

