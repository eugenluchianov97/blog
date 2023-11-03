@extends('layouts.admin')

{{--@section('breadcrumbs')--}}
{{--    @component('components.breadcrumbs',[--}}
{{--    'items' => [--}}
{{--        ['title' => 'Главная','route' => route('admin.index'),'active' => true],--}}
{{--        ['title' => 'Категории','route' => route('admin.categories.index'),'active' => true],--}}
{{--        ['title' => 'Создать','route' => route('admin.categories.create'),'active' => false],--}}

{{--     ]])@endcomponent--}}
{{--@endsection--}}

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form action="{{route('admin.products.update',['product' => $product->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#RU" role="tab" aria-selected="true">RU</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#RO" role="tab" aria-selected="false">RO</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#EN" role="tab" aria-selected="false">EN</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3" id="custom-tabs-five-tabContent">
                                <div class="tab-pane fade show active" id="RU" role="tabpanel" >
                                    <div class="form-group ">
                                        <label for="exampleInputEmail1">Название <sup>RU</sup></label>
                                        <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Название" value="{{ $product->name }}">
                                        @error('name')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Описание <sup>RU</sup></label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Описание">{{ $product->description }}</textarea>
                                        @error('description')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="RO" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Название <sup>RO</sup> </label>
                                        <input name="name_ro" type="text" class="form-control  @error('name_ro') is-invalid @enderror" placeholder="Название" value="{{ $product->name_ro }}">
                                        @error('name_ro')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="form-group ">
                                        <label>Описание<sup>RO</sup></label>
                                        <textarea name="description_ro" class="form-control @error('description_ro') is-invalid @enderror" rows="3" placeholder="Описание">{{ $product->description_ro }}</textarea>
                                        @error('description_ro')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="EN" role="tabpanel">
                                    <div class="form-group ">
                                        <label for="exampleInputEmail1">Название <sup>EN</sup> </label>
                                        <input name="name_en" type="text" class="form-control  @error('name_en') is-invalid @enderror" placeholder="Название" value="{{ $product->name_en }}">
                                        @error('name_en')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Описание<sup>EN</sup></label>
                                        <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="3" placeholder="Описание">{{ $product->description_en }}</textarea>
                                        @error('description_en')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Цена</label>
                                    <input name="price" type="number" class="form-control  @error('price') is-invalid @enderror" placeholder="Стоимость" value="{{$product->price }}">
                                    @error('price')<p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label>Цена со скидкой</label>
                                    <input name="discount_price" type="number" class="form-control  @error('discount_price') is-invalid @enderror" placeholder="Стоимость со скидкой" value="{{$product->discount_price }}">
                                    @error('discount_price')<p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Категории</label>
                                <select name="categories[]" class="select2 @error('categories') is-invalid @enderror" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                    @foreach($categories as $category)
                                        <option @if($product->categories->contains('id', $category->id)) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach


                                </select>
                                @error('categories')<p class="text-danger">{{ $message }}</p> @enderror
                            </div>


                            <div class="custom-control custom-checkbox">

                                <input name="recommended" class="custom-control-input" type="checkbox" @if($product->recommended) checked @endif id="customCheckbox1" >
                                <label for="customCheckbox1" class="custom-control-label">Добавить в рекомендованное</label>
                            </div>


                            <div class="form-group mt-5">
                                <label for="exampleInputFile">Изображение товара</label>
                                <p class="mt-1">
                                    <label for="attachment">
                                        <a class="btn btn-primary text-light" role="button" aria-disabled="false">Добавить изображения</a>
                                    </label>

                                    <input type="file" name="files[]" id="attachment" style="visibility: hidden; position: absolute;" multiple/>

                                </p>
                                <div id="files-names" class="row">
                                    @foreach($product->images as $image)
                                        <div class="col-6 position-relative p-1">
                                            <i data-id="{{$image->id}}" class="file-delete-old nav-icon fas fa-trash text-danger position-absolute" style="top:20px; left:20px;cursor:pointer"></i>
                                            <input data-hidden-id="{{$image->id}}" type="hidden" name="current_images[]" value="{{$image->id}}">
                                            <img width="100%" src="{{$image->image}}"/>
                                        </div>


                                    @endforeach
                                </div>
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
        const dt = new DataTransfer();

        $("#attachment").on('change', function(e){
            for(let i = 0; i < this.files.length; i++){
                let block = '<div class="col-6 position-relative"><i data-id="'+i+'" class="file-delete nav-icon fas fa-trash text-danger position-absolute" style="top:20px; left:20px;cursor:pointer"></i><img width="100%" src="'+URL.createObjectURL(e.target.files[i])+'"></div>';
                $("#files-names").append(block);
            };

            for (let file of this.files) {
                dt.items.add(file);
            }

            this.files = dt.files;

            $('i.file-delete').click(function(){
                let id = $(this).data('id');

                $(this).parent().remove();

                for(let i = 0; i < dt.items.length; i++){
                    if(id === i){
                        dt.items.remove(i);
                        continue;
                    }
                }
                document.getElementById('attachment').files = dt.files;
            });
        });



        $('i.file-delete-old').click(function(){
            console.log('here');
            $(this).parent().remove();

        });

    </script>
    <script>
        $('.select2').select2({ theme: 'bootstrap4'})


    </script>

@endsection

