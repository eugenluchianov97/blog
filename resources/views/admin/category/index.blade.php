@extends('layouts.admin')

@section('breadcrumbs')
    @component('components.breadcrumbs',[
    'items' => [
        ['title' => 'Главная','route' => route('admin.index'),'active' => true],
        ['title' => 'Категории','route' => route('admin.categories.index'),'active' => false],

     ]])@endcomponent
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a href="{{route('admin.categories.create')}}" class="btn btn-dark my-2">Добавить категорию</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Название<sup>RU</sup></th>
                                    <th>Название<sup>RO</sup></th>
                                    <th>Название<sup>EN</sup></th>
                                    <th>Алиас</th>
                                    <th>Дата создания</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($categories) > 0)

                                @foreach($categories as $k => $category)
                                    <tr>
                                        <td>{{($k + 1) + $categories->perPage() * ($categories->currentPage() - 1) }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->name_ro }}</td>
                                        <td>{{ $category->name_en }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->created_at->format('d.m.Y [H:i]') }}</td>
                                        <td>
                                            <a href="{{route('admin.categories.show',['category' => $category->id])}}" class="mx-1">
                                                <i class="fas fa-eye text-primary"></i>
                                            </a>
                                            <a href="{{route('admin.categories.edit',['category' => $category->id])}}" class="mx-1">
                                                <i class="fa fa-pen text-warning"></i>
                                            </a>

                                            <a href="" class="mx-1" data-toggle="modal" data-target="#modal-default{{ $category->id}}">
                                                <i class="fas fa-trash text-danger" ></i>
                                            </a>
                                            <div class="modal fade" id="modal-default{{ $category->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <p>Вы действительно хотите удалить запись?</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                                            <form action="{{route('admin.categories.delete',['category' => $category->id])}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Удалить</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">
                                        <p class="text-center m-0">Нет записей</p>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        @include('components.pagination',['collection' => $categories, 'route' =>'admin.users.index'])
    </div>



@endsection


@section('scripts')

@endsection

