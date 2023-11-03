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
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                                        <input name="name_ru" type="text" class="form-control  @error('name_ru') is-invalid @enderror" placeholder="Название" value="{{ old('name_ru') }}">
                                        @error('name_ru')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Описание <sup>RU</sup></label>
                                        <textarea  name="content_ru" class="summernote form-control @error('content_ru') is-invalid @enderror" rows="13" placeholder="Описание">{{ old('content_ru') }}</textarea>
                                        @error('content_ru')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="RO" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Название <sup>RO</sup> </label>
                                        <input name="name_ro" type="text" class="form-control  @error('name_ro') is-invalid @enderror" placeholder="Название" value="{{ old('name_ro') }}">
                                        @error('name_ro')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="form-group ">
                                        <label>Описание<sup>RO</sup></label>
                                        <textarea  name="content_ro" class="summernote form-control @error('content_ro') is-invalid @enderror" rows="13" placeholder="Описание">{{ old('content_ro') }}</textarea>
                                        @error('content_ro')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="EN" role="tabpanel">
                                    <div class="form-group ">
                                        <label for="exampleInputEmail1">Название <sup>EN</sup> </label>
                                        <input name="name_en" type="text" class="form-control  @error('name_en') is-invalid @enderror" placeholder="Название" value="{{ old('name') }}">
                                        @error('name_en')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Описание<sup>EN</sup></label>
                                        <textarea name="content_en" class="summernote form-control @error('content_en') is-invalid @enderror" rows="13" placeholder="Описание">{{ old('content_en') }}</textarea>
                                        @error('content_en')<p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Категории</label>
                                <select name="categories_id[]" class="select2 @error('categories_id') is-invalid @enderror" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach

                                </select>
                                @error('categories_id')<p class="text-danger">{{ $message }}</p> @enderror
                            </div>



                            <div class="form-group mt-5">
                                <label for="exampleInputFile">Изображение товара</label>
                                <p class="mt-1">
                                    <label for="attachment">
                                        <a class="btn btn-outline-dark " role="button" aria-disabled="false">Добавить изображения</a>
                                    </label>

                                    <input type="file" name="preview_picture" id="attachment" style="visibility: hidden; position: absolute;" />

                                </p>
                                <div id="files-names" class="row"></div>
                            </div>

                            @if(old('files'))
                                @foreach(old('files') as $file)
                                    <input type="text" name="files[]" value="{{$file}}">
                                @endforeach
                            @endif
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-dark">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <style>

    </style>
@endsection


@section('scripts')

    <script>
        $(document).ready(() => {
            $('.select2').select2({ theme: 'bootstrap4'})


            const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

            $("#attachment").on('change', function(e){
                for(let i = 0; i < this.files.length; i++){
                    let block = '<div class="col-6 position-relative p-2"><i data-id="'+i+'" class="file-delete nav-icon fas fa-trash text-danger position-absolute" style="top:20px; left:20px;cursor:pointer"></i><img width="100%" src="'+URL.createObjectURL(e.target.files[i])+'"></div>';
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

            $('textarea.summernote').summernote({
                height: 400,
                callbacks: {
                    onImageUpload: function(files) {

                        sendFile(files[0],$(this));
                    },

                }

            })

            function sendFile(file,editor) {


                let data = new FormData();
                data.append("file", file);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: data,
                    type: "POST",
                    url: "{{route('admin.image.store')}}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        editor.summernote("insertImage", url, url);
                        editor.closest('form').append('<input type="hidden" name="files[]" value="'+url+'" >')

                    }
                });
            }
        })


    </script>


@endsection

