
<ul class="dropdown-menu">
    @foreach($children as $child)
        <li>
            <a class="dropdown-item" href="single.html">{{ $child->name }} @if(count($child->children) > 0)<span class="hidden-md-down hidden-sm-down hidden-xs-down"><i class="fa fa-angle-right"></i>@endif</span></a>
            @if(count($child->children) > 0)
                @include('front.includes.categoryChild',['children' => $child->children])
            @endif
        </li>
    @endforeach

</ul>
