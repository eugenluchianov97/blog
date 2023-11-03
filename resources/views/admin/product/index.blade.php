@extends('layouts.admin')

{{--@section('breadcrumbs')--}}
{{--    @component('components.breadcrumbs',[--}}
{{--    'items' => [--}}
{{--        ['title' => 'Главная','route' => route('admin.index'),'active' => true],--}}
{{--        ['title' => 'Категории','route' => route('admin.categories.index'),'active' => false],--}}

{{--     ]])@endcomponent--}}
{{--@endsection--}}



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a href="{{route('admin.products.create')}}" class="btn btn-dark my-2">Добавить товар</a>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <form action="{{route('admin.products.index')}}">
                    <div class="form-group">
                        <label for="exampleSelectRounded0">Категория</label>
                        <select name="category" class="custom-select rounded-0" id="filterByCategory">
                            <option value="0" {{is_null(request()->input('category')) ? 'selected' : ''}}>Все</option>
                            @foreach($categories as $category)
                                <option {{request()->input('category') == $category->id ? 'selected' : ''}} value="{{$category->id}}">
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
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
                                    <th>Цена</th>
                                    <th>Дата создания</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($products) > 0)

                                @foreach($products as $k => $product)
                                    <tr>
                                        <td>{{($k + 1) + $products->perPage() * ($products->currentPage() - 1) }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->name_ro }}</td>
                                        <td>{{ $product->name_en }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->created_at->format('d.m.Y [H:i]') }}</td>
                                        <td>
                                            <a href="{{route('admin.products.show',['product' => $product->id])}}" class="mx-1">
                                                <i class="fas fa-eye text-primary"></i>
                                            </a>
                                            <a href="{{route('admin.products.edit',['product' => $product->id])}}" class="mx-1">
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
                                                            <form action="{{route('admin.products.delete',['product' => $product->id])}}" method="POST">
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
                                    <td colspan="7">
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

        @include('components.pagination',['collection' => $products, 'route' =>'admin.products.index'])
    </div>



@endsection


@section('scripts')
    <script>
        $('#filterByCategory').on('change',function(){
            $(this).closest('form').submit()
        });
    </script>

@endsection

