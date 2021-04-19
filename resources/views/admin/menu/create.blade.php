@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
<section id="nb-create-article">
    <div class="container-fluid mt-3">
        <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-info-circle"></i> Thông tin chung
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Tiêu đề <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="text-small text-gray help-block-none">Nhập tiêu đề menu.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Vị trí <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10 mb-3">
                                    <select size="5" class="form-control" name="location_id">
                                        <option value="" selected>--Chọn--</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('location_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="text-small text-gray help-block-none">Chọn vị trí menu.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Url <span class="text-danger"></span>:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control nb-getlink" name="url" value="{{ old('url') }}">

                                    <span class="text-small text-gray help-block-none"> Nhập link cho menu (nếu điền thì không cần nhập phần bên dưới).</span>
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-primary btn-get-link" type="button">Lấy link bài viết</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Module <span class="text-danger"></span>:</label>
                                <div class="col-sm-10 mb-3">
                                    <select size="5" class="form-control module" name="module" id="module">
                                        <option value="" selected>--Chọn--</option>
                                        @foreach (config('variables.modules') as $key => $module)
                                            <option value="{{ $key }}">{{ $module }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-small text-gray help-block-none">Chọn module của menu.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Module ID<span class="text-danger"></span>:</label>
                                <div class="col-sm-10 mb-3">
                                    <select size="5" class="form-control md-select" name="module_id" id="module_id">
                                        <option value="" selected>--Chọn--</option>
                                        {{-- @foreach ($productCate as $item) --}}
                                            {{-- <option value="{{ $item->id }}" data-chained="product_catalogua">{{ $item->name }}</option> --}}
                                            {{ showCategories($productCate) }}
                                        {{-- @endforeach --}}
                                        @foreach ($aricleCate as $item)
                                            <option value="{{ $item->id }}" data-chained="article_catalogua">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-small text-gray help-block-none">Chọn các danh mục con trong module.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Module item<span class="text-danger"></span>:</label>
                                <div class="col-sm-10 mb-3">
                                    <select size="5" class="form-control" name="module_item" id="module_item">
                                        <option value="" selected>--Chọn--</option>
                                        {{-- <option value="a" data-chained="{{ $key }}"> Hiện tất cả các danh mục con</option> --}}
                                        @foreach (config('variables.module_item') as $key => $module_item)
                                            <option value="@if ($key == 'product_catalogua')
                                                child_category
                                            @else
                                                child_category
                                            @endif" data-chained="{{ $key }}">Hiển thị danh mục con</option>
                                        @endforeach
                                        @foreach (config('variables.module_item') as $key => $module_item)
                                            <option value="@if ($key == 'product_catalogua')
                                                product
                                            @else
                                                article
                                            @endif" data-chained="{{ $key }}">{{ $module_item }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-small text-gray help-block-none"> Chọn cách hiển thị của module.</span>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Thao tác</label>
                                <div class="col-sm-10 mb-3">
                                    <button class="btn btn-primary" type="submit" name="close" value="close">Lưu lại và thoát</button>
                                    <button class="btn btn-primary" type="submit" name="back" value="back">Lưu lại và thêm mới</button>
                                    <button class="btn btn-primary" type="reset">Làm lại</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-gift fa-lg"></i> Tùy chọn
                        </div>
                        <div class="card-body">
                            <div class="form-group d-flex">
                                <div class="form-check-inline nb-create-article-category-title-op">
                                    <label class="form-control-label ">Hiển thị:</label>
                                </div>
                                <div>
                                    <div class="form-check-inline mb-1">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="publish" value="0" checked>
                                            <span class="bg-secondary nb-check text-white">Không</span>
                                        </label>
                                    </div>
                                    <div class="form-check-inline mb-1 ">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="publish" value="1">
                                            <span class="bg-success text-white nb-check">Có</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-flex">
                                <div class="form-check-inline nb-create-article-category-title-op">
                                    <label class="form-control-label ">Ngôn ngữ:</label>
                                </div>
                                <div>
                                    <div class="form-check-inline mb-1">
                                        <a href="void:javascript(0)" class="btn btn-primary text-decoration-none trans">Nội dung</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @include('partials.admin.modal_menu_trans')
        </form>
    </div>
</section>

@endsection
@section('script')
<script>

    $(function(){
        // addLanguage()



        $('.trans').click(function(){
            $('#menuTrans').modal()
        })

        // function addLanguage(){
            // var OpenFormGroup = '<div class="form-group">'
            // var CloseDiv = '</div>'
            // var OpenLabel = '<label>'
            // var CloseLabel = '</label>'

            // var form = ''
            // $('.add-lang').click(function(){
            //     form += OpenFormGroup
            //     form += '<label for="title_lang">Tiêu đề:</label>'
            //     form += '<input type="text" id="title_lang" name="title_lang" class="form-control" placeholder="Nhập tiêu đề ngôn ngữ mới">'
            //     form += CloseDiv

            //     $('.form-lang').before(form)
            // })
        // }


        $("#module_id").chained("#module");
        $("#module_item").chained("#module");

        var getlink = localStorage.getItem("stringToPass");
        localStorage.removeItem( 'stringToPass' ); // Clear the localStorage
        if(getlink != null) {

            $('.nb-getlink').val(getlink)
        }

        console.log(getlink)

        $('.btn-get-link').click(function (event) {
            event.preventDefault();
            var w = window.open("{{ route('post.index') }}", "popupWindow", "width=1150, height=600, scrollbars=yes");
        });
    })


</script>
@endsection


