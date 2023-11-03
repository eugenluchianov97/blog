<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">

        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                @foreach($items as $item)
                    <li class="breadcrumb-item @if($item['active']) active @endif">
                        @if($item['active'])
                            <a href="{{$item['route']}}">{{$item['title']}}</a>
                        @else
                            {{$item['title']}}
                        @endif

                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
