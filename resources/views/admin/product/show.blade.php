@extends('layouts.admin')

{{--@section('breadcrumbs')--}}
{{--    @component('components.breadcrumbs',[--}}
{{--    'items' => [--}}
{{--        ['title' => 'Главная','route' => route('admin.index'),'active' => true],--}}
{{--        ['title' => 'Категории','route' => route('admin.categories.index'),'active' => true],--}}
{{--        ['title' => $category->name,'active' => false],--}}

{{--     ]])@endcomponent--}}
{{--@endsection--}}

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered data-table">
                            <tbody>
                                <tr>
                                    <th>Название<sup>RU</sup> </th>
                                    <td>{{$product->name}}</td>
                                </tr>
                                <tr>
                                    <th>Название<sup>RO</sup> </th>
                                    <td>{{$product->name_ro}}</td>
                                </tr>
                                <tr>
                                    <th>Название<sup>EN</sup> </th>
                                    <td>{{$product->name_en}}</td>
                                </tr>
                                <tr>
                                    <th>Описание<sup>RU</sup> </th>
                                    <td>{{$product->description}}</td>
                                </tr>
                                <tr>
                                    <th>Описание<sup>RO</sup> </th>
                                    <td>{{$product->description_ro}}</td>
                                </tr>
                                <tr>
                                    <th>Описание<sup>EN</sup> </th>
                                    <td>{{$product->description_en}}</td>
                                </tr>
                                <tr>
                                    <th>Цена</th>
                                    <td>{{$product->price}}</td>
                                </tr>
                                <tr>
                                    <th>Цена со скидкой</th>
                                    <td>{{$product->discount_price}}</td>
                                </tr>
                                <tr>
                                    <th>Рекомендованный</th>
                                    <td>
                                        @if(!$product->recomended)
                                            -
                                        @else
                                            Да
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Категория</th>
                                    <td>
                                        <ol>
                                            @foreach($product->categories as $category)
                                                <li>{{$category->name}}</li>
                                            @endforeach
                                        </ol>

                                    </td>
                                </tr>
                                <tr>
                                    <th>Изображения</th>
                                    <td>
                                        <div class="row">
                                            @foreach($product->images as $image)
                                                <img class="col-6" src="{{$image->image}}">
                                            @endforeach
                                        </div>

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection


@section('scripts')

@endsection

