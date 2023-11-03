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
                <div class="card card-primary">
                    {{$user->is_admin()}}
                    <form action="{{route('admin.users.update',['user' => $user->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Имя <sup>*</sup></label>
                                <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Имя" value="{{$user->name }}">
                                @error('name')<p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email <sup>*</sup></label>
                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Имя" value="{{ $user->email }}">
                                @error('email')<p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label>Роли</label>
                                <select name="roles[]" class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                    @foreach($roles as $role)
                                        <option @if($user->roles->contains('id',$role->id)) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Пароль</label>
                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"  placeholder="Пароль">
                                @error('password')<p class="text-danger">{{ $message }}</p> @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Подтверждение пароля</label>
                                <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror"  placeholder="Подтверждение пароля">
                                @error('password_confirmation')<p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-dark">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $('.select2').select2({ theme: 'bootstrap4'})
    </script>
@endsection

