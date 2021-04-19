@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
<section id="nb-create-article">
    <div class="container-fluid mt-3">
        <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <span class="text-small text-gray help-block-none">Nhập tiêu đề ảnh.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Hình đại diện <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10 mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="avatar_image" name="avatar_image" readonly value="{{ old('avatar_image') }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary browser2" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='avatar_image'>Browser</button>
                                        </div>
                                    </div>
                                    @error('avatar_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="text-small text-gray help-block-none">Chọn hình đại diện của slide.</span>
                                    <br>
                                    <img src="{{ asset(old('avatar_image')) }}" alt="" class="img-fluid avatar-img" width="100px" height="100px">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Link quảng cáo <span class="text-danger"></span>:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="link" value="{{ old('link') }}">
                                    <span class="text-small text-gray help-block-none">Nhập link quảng cáo.</span>
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

                        </div>

                    </div>

                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-thumbs-o-up fa-lg"></i> Meta
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Title: 70 kí tự</label>
                                <input type="text" class="form-control" placeholder="Nhập tiêu đề sản phẩm" name="meta_title" value="{{ old('meta_title') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Keywords: 70 kí tự</label>
                                <input type="text" class="form-control" placeholder="Nhập các từ khóa cho SEO" name="meta_keywords" value="{{ old('meta_keywords') }}">
                            </div>
                            <div class="form-group">
                                <label for="">Description: 160 kí tự</label>
                                <textarea id="" cols="30" rows="5" class="form-control" name="meta_description">{{ old('meta_description') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@include('partials.admin.modal_gallery')
@endsection
@section('script')
    <script>
    $(function(){
         // click avatar_image open filemanager
         $('.browser2').click(function(){
            var input_id2 = $('.browser2').attr('data-name-type');
            $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input_id2+'&akey='+akey+'") !!}');
        })

        // show image
        $('#modal-file').on('hidden.bs.modal', function (e) {
            // var url_images = $('#images').val();
            var url_avatar_img = $('#avatar_image').val();

            // $('.cate-img').attr('src', url_cate_img);
            $('.avatar-img').attr('src', url_avatar_img);
        });
    })
    </script>
@endsection

