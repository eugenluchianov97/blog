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
                                    <td>{{$post->name_ru}}</td>
                                </tr>
                                <tr>
                                    <th>Название<sup>RO</sup> </th>
                                    <td>{{$post->name_ro}}</td>
                                </tr>
                                <tr>
                                    <th>Название<sup>EN</sup> </th>
                                    <td>{{$post->name_en}}</td>
                                </tr>
                                <tr>
                                    <th>Контент<sup>RU</sup> </th>
                                    <td>{!! $post->content_ru !!}</td>
                                </tr>
                                <tr>
                                    <th>Контент<sup>RO</sup> </th>
                                    <td>{!!$post->content_ro!!}</td>
                                </tr>
                                <tr>
                                    <th>Контент<sup>EN</sup> </th>
                                    <td>{!!$post->content_en!!}</td>
                                </tr>
                                <tr>
                                    <th>Категория</th>
                                    <td>
                                        <ol>
                                            @foreach($post->categories as $category)
                                               <li>{{$category->name}}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Изображение</th>
                                    <td>
                                       <img style="width:300px" src="{{$post->preview_picture}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Дата создания</th>
                                    <td>
                                        {{$post->created_at}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Дата редактирования</th>
                                    <td>
                                        {{$post->updated_at}}
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

