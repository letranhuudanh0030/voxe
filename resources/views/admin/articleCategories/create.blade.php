@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
<section id="nb-create-article-category">
    <div class="container-fluid mt-3">
        <form action="{{ route('catalogue.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-info-circle"></i> Thông tin chung
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Tên danh mục <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="text-small text-gray help-block-none">Nhập tên danh mục bài viết.</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Chọn danh mục</label>
                                <div class="col-sm-10 mb-3">
                                    <select size="5" class="form-control" name="parent_id">
                                        <option value="0" selected>--Chọn--</option>
                                        @if ($articleCategories)
                                            {{ showCategories($articleCategories) }}
                                        @else
                                            There are no subcategories
                                        @endif
                                    </select>
                                    <span class="text-small text-gray help-block-none">Chọn danh mục (Nếu không chọn mặc định sẽ là Cấp 1).</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Chọn loại trang</label>
                                <div class="col-sm-10 mb-3">
                                    <select size="5" class="form-control" name="page_type">
                                        @foreach (config('variables.page_type') as $key => $item)
                                            <option value="{{ $key }}" @if ($key == 0)
                                            selected
                                            @endif>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-small text-gray help-block-none">Nếu không chọn mặc định sẽ là loại trang mặc định.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Hình danh mục</label>
                                <div class="col-sm-10 mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="category_image" name="cate_image" readonly value="{{ old('cate_image') }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary browser" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='category_image'>Browser</button>
                                        </div>
                                    </div>
                                    <span class="text-small text-gray help-block-none">Chọn hình của danh mục.</span>
                                    <br>
                                    <img src="{{ asset(old('cate_image')) }}" alt="" class="img-fluid cate-img" width="150px" height="150px">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Hình đại diện</label>
                                <div class="col-sm-10 mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="avatar_image" name="avatar_image" readonly value="{{ old('avatar_image') }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary browser2" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='avatar_image'>Browser</button>
                                        </div>
                                    </div>
                                    <span class="text-small text-gray help-block-none">Chọn hình đại diện của danh mục.</span>
                                    <br>
                                    <img src="{{ asset(old('avatar_image')) }}" alt="" class="img-fluid avatar-img" width="100px" height="100px">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Mô tả ngắn</label>
                                <div class="col-sm-10 mb-3">
                                    <textarea id="short-desc" cols="30" rows="10" class="form-control" name="short_desc">{{ old('short_desc') }}</textarea>

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
                                    <label class="form-control-label">Nổi bật:</label>
                                </div>
                                <div>

                                    <div class="form-check-inline mb-1">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="highlight" value="0" checked>
                                            <span class="bg-secondary nb-check text-white">Không</span>
                                        </label>
                                    </div>
                                    <div class="form-check-inline mb-1">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="highlight" value="1">
                                            <span class="bg-success text-white nb-check">Có</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group d-flex">
                                <div class="form-check-inline nb-create-article-category-title-op">
                                    <label class="form-control-label">1 bài viết:</label>
                                </div>
                                <div>

                                    <div class="form-check-inline mb-1">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="one_article" value="0" checked>
                                            <span class="bg-secondary nb-check text-white">Không</span>
                                        </label>
                                    </div>
                                    <div class="form-check-inline mb-1">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="one_article" value="1">
                                            <span class="bg-success text-white nb-check">Có</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group d-flex">
                                <div class="form-check-inline nb-create-article-category-title-op">
                                    <label class="form-control-label">Bỏ link:</label>
                                </div>
                                <div>

                                    <div class="form-check-inline mb-1">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="unlink" value="0" checked>
                                            <span class="bg-secondary nb-check text-white">Không</span>
                                        </label>
                                    </div>
                                    <div class="form-check-inline mb-1">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="unlink" value="1">
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

                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-gears fa-lg"></i> Cấu hình
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Canonical:</label>
                                    <input type="text" class="form-control" readonly value="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-thumbs-o-up fa-lg"></i> Meta
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Title: 70 kí tự</label>
                                <input type="text" class="form-control" placeholder="Nhập tiêu đề danh mục" name="meta_title" value="{{ old('meta_title') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Slug:</label>
                                <input type="text" class="form-control" placeholder="Nhập link slug (nếu có)" name="slug" value="{{ old('slug') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Keywords: 70 kí tự</label>
                                <input type="text" class="form-control" placeholder="Nhập các từ khó cho SEO" name="meta_keywords" value="{{ old('meta_keywords') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Description: 160 kí tự</label>
                                <textarea id="" cols="30" rows="5" class="form-control" name="meta_description">{{ old('meta_description') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.admin.modal_article_category_trans')
        </form>
    </div>
</section>
<!-- Modal -->
@include('partials.admin.modal_gallery')
@endsection
@section('script')
    <script>
        $(function () {

            $('.trans').click(function(){
                $('#categoryTrans').modal()
            })

            // click categort_image open filemanager
            $('.browser').click(function(){
                var input_id = $('.browser').attr('data-name-type');
                $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input_id+'&akey='+akey+'") !!}');
            })

            // click avatar_image open filemanager
            $('.browser2').click(function(){
                var input_id2 = $('.browser2').attr('data-name-type');
                $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input_id2+'&akey='+akey+'") !!}');
            })

            // show image
            $('#modal-file').on('hidden.bs.modal', function (e) {
                var url_cate_img = $('#category_image').val();
                var url_avatar_img = $('#avatar_image').val();

                $('.cate-img').attr('src', url_cate_img);
                $('.avatar-img').attr('src', url_avatar_img);

            });
        });
    </script>
@endsection