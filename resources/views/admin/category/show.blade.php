@extends('layouts.admin')

@section('breadcrumbs')
    @component('components.breadcrumbs',[
    'items' => [
        ['title' => 'Главная','route' => route('admin.index'),'active' => true],
        ['title' => 'Категории','route' => route('admin.categories.index'),'active' => true],
        ['title' => $category->name,'active' => false],

     ]])@endcomponent
@endsection

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
                                    <td>{{$category->name}}</td>
                                </tr>
                                <tr>
                                    <th>Название<sup>RO</sup> </th>
                                    <td>{{$category->name_ro}}</td>
                                </tr>
                                <tr>
                                    <th>Название<sup>EN</sup> </th>
                                    <td>{{$category->name_en}}</td>
                                </tr>
                                <tr>
                                    <th>Алиас </th>
                                    <td>{{$category->slug}}</td>
                                </tr>
                                <tr>
                                    <th>Описание <sup>RU</sup> </th>
                                    <td>
                                        @if(isset($category->description))
                                            {{$category->description}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Описание <sup>RO</sup></th>
                                    <td>
                                        @if(isset($category->description_ro))
                                            {{$category->description_ro}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Описание <sup>EN</sup></th>
                                    <td>
                                        @if(isset($category->description_en))
                                            {{$category->description_en}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Родительская категория </th>
                                    <td>
                                        @if(isset($category->parent))
                                            <a href="{{route('admin.categories.show',['category' =>$category->parent->id ])}}">
                                                {{$category->parent->name}}
                                            </a>

                                        @else
                                            -
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <th>Дата создания </th>
                                    <td>
                                        {{$category->created_at->format('d.m.Y h:i')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Дата обновления </th>
                                    <td>
                                        {{$category->updated_at->format('d.m.Y h:i')}}
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

