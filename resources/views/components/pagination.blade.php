<div class="row">
    <div class="col-sm-12 col-md-4">
        <div class="dataTables_info">
            От {{1 + $collection->perPage() * ($collection->currentPage() - 1) }} до {{count($collection->items()) + $collection->perPage() * ($collection->currentPage() - 1) }} из {{$collection->total()}}
        </div>
    </div>

    <div class="col-sm-12 col-md-8 d-flex justify-content-end">
        <div class="dataTables_paginate paging_simple_numbers">
            <ul class="pagination">
                <li class="paginate_button page-item previous @if( $collection->currentPage() <= 1) disabled @endif ">
                    <a href="{{route($route,['page' => $collection->currentPage() - 1])}}" class="page-link">Назад</a>
                </li>

                @for($i = 1; $i <= $collection->lastPage();$i++)
                    <li class="paginate_button page-item @if($collection->currentPage() === $i) active @endif">
                        <a href="{{route($route,['page' =>$i])}}" class="page-link">{{$i}}</a>
                    </li>
                @endfor

                <li class="paginate_button page-item next @if( $collection->currentPage() >= $collection->lastPage()) disabled @endif" >
                    <a href="{{route($route,['page' => $collection->currentPage() + 1])}}" class="page-link">Далее</a>
                </li>
            </ul>
        </div>
    </div>

</div>
