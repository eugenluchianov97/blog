@extends('layouts.admin')

@section('breadcrumbs')
    @component('components.breadcrumbs',[
    'items' => [
        ['title' => 'Главная','route' => route('admin.index'),'active' => true],
        ['title' => 'Пользователи','route' => route('admin.users.index'),'active' => true],
        ['title' => $user->name,'active' => false],

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
                                    <th>Имя </th>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <th>Email </th>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <th>Роли</th>
                                    <td>
                                        @if(count($user->roles) > 0)
                                            <ol>
                                                @foreach($user->roles as $role)
                                                    <li>{{$role->name}}</li>
                                                @endforeach
                                            </ol>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Дата создания </th>
                                    <td>{{$user->created_at->format('d.m.Y [H:i]')}}</td>
                                </tr>
                                <tr>
                                    <th>Дата обновления  </th>
                                    <td>{{$user->updated_at->format('d.m.Y [H:i]')}}</td>
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

