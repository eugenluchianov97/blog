@extends('layouts.admin')

@section('breadcrumbs')
    @component('components.breadcrumbs',[
    'items' => [
        ['title' => 'Главная','route' => route('admin.index'),'active' => true],
        ['title' => 'Категории','route' => route('admin.categories.index'),'active' => true],
        ['title' => 'Создать','route' => route('admin.categories.create'),'active' => false],

     ]])@endcomponent
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form action="{{route('admin.categories.update',['category' => $category->id])}}" method="POST" enctype="multipart/form-data">
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
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Название <sup>RU</sup> </label>
                                        <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Название" value="{{$category->name }}">
                                        @error('name')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Описание<sup>RU</sup></label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Описание">{{$category->description }}</textarea>
                                        @error('description')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="RO" role="tabpanel" >
                                    <div class="form-group ">
                                        <label for="exampleInputEmail1">Название <sup>RO</sup> </label>
                                        <input name="name_ro" type="text" class="form-control  @error('name_ro') is-invalid @enderror" placeholder="Название" value="{{$category->name_ro }}">
                                        @error('name_ro')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Описание<sup>RO</sup></label>
                                        <textarea name="description_ro" class="form-control @error('description_ro') is-invalid @enderror" rows="3" placeholder="Описание">{{$category->description_ro }}</textarea>
                                        @error('description_ro')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="EN" role="tabpanel">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Название <sup>EN</sup> </label>
                                        <input name="name_en" type="text" class="form-control  @error('name_en') is-invalid @enderror" placeholder="Название" value="{{$category->name_en }}">
                                        @error('name_ro')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Описание<sup>EN</sup></label>
                                        <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="3" placeholder="Описание">{{$category->description_en }}</textarea>
                                        @error('description_en')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="exampleInputEmail1">Алиас</label>
                                    <input name="slug" type="text" class="form-control  @error('slug') is-invalid @enderror" placeholder="Алиас" value="{{$category->slug }}">
                                    @error('slug')<p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                @if(count($categories) > 0)
                                    <div class="form-group col-6">

                                        <label for="exampleSelectRounded0">Родительская категория</label>
                                        <select name="parent_id" class="custom-select rounded-0" id="exampleSelectRounded0">
                                            <option value="">Не выбранно</option>
                                            @foreach($categories as $item)
                                                @if($item->id !== $category->id )
                                                    <option @if($category->parent_id === $item->id) selected @endif value="{{$item->id}}">
                                                        {{$item->name}}
                                                    </option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </div>
                                @endif

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

        const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

        $("#attachment").on('change', function(e){
            for(let i = 0; i < this.files.length; i++){
                let block = '<div class="col-6 position-relative p-2"><i data-id="'+i+'" class="file-delete nav-icon fas fa-trash text-danger position-absolute" style="top:20px; left:20px;cursor:pointer"></i><img width="100%" src="'+URL.createObjectURL(e.target.files[i])+'"></div>';
                $("#files-names").html(block);
            };

            for (let file of this.files) {
                dt.items.add(file);
            }

            this.files = dt.files;


        });
        $('i.file-delete').click(function(){
            let id = $(this).data('id');
            console.log('here')

            $(this).parent().remove();

            for(let i = 0; i < dt.items.length; i++){
                if(id === i){
                    dt.items.remove(i);
                    continue;
                }
            }
            document.getElementById('attachment').files = dt.files;
        });
    </script>

@endsection

