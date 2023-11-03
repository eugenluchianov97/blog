@extends('layouts.admin')

@section('breadcrumbs')
    @component('components.breadcrumbs',[
    'items' => [
        ['title' => 'Главная','route' => route('admin.index'),'active' => true],
        ['title' => 'Пользователи','route' => route('admin.users.index'),'active' => false],

     ]])@endcomponent
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a href="{{route('admin.users.create')}}" class="btn btn-dark my-2">Добавить пользователя</a>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($users) > 0)
                                    @foreach($users as $k => $user)
                                        <tr>
                                            <td>{{($k + 1) + $users->perPage() * ($users->currentPage() - 1) }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('d.m.Y [H:i]') }}</td>
                                            <td>
                                                <a href="{{route('admin.users.show',['user' => $user->id])}}" class="mx-1">
                                                    <i class="fas fa-eye text-primary"></i>
                                                </a>
                                                <a href="{{route('admin.users.edit',['user' => $user->id])}}" class="mx-1">
                                                    <i class="fa fa-pen text-warning"></i>
                                                </a>

                                                <a href="" class="mx-1" data-toggle="modal" data-target="#modal-default">
                                                    <i class="fas fa-trash text-danger" ></i>
                                                </a>
                                                <div class="modal fade" id="modal-default">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <p>Вы действительно хотите удалить запись?</p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                                                <form action="{{route('admin.users.delete',['user' => $user->id])}}" method="POST">
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

        @include('components.pagination',['collection' => $users, 'route' =>'admin.users.index'])

    </div>



@endsection


@section('scripts')

@endsection

