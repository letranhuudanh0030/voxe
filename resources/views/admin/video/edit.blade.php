@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
<section id="nb-create-article">
    <div class="container-fluid mt-3">
        <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                    <input type="text" class="form-control" name="title" value="{{ $video->title }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="text-small text-gray help-block-none">Nhập tiêu đề video.</span>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Link video <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="link" value="{{ $video->link }}">
                                    @error('link')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="text-small text-gray help-block-none">Nhập link video (bắt buộc). Vd : bH0CxufEegM</span>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Thao tác</label>
                                <div class="col-sm-10 mb-3">
                                    <button class="btn btn-primary" type="submit">Thay đổi</button>

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
                                            <input type="radio" class="form-check-input " name="publish" value="0" @if (!$video->publish)
                                                checked
                                            @endif>
                                            <span class="bg-secondary nb-check text-white">Không</span>
                                        </label>
                                    </div>
                                    <div class="form-check-inline mb-1 ">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="publish" value="1" @if ($video->publish)
                                            checked
                                        @endif>
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
                                <input type="text" class="form-control" placeholder="Nhập tiêu đề sản phẩm" name="meta_title" value="{{ $video->meta_title }}">
                            </div>
                            <div class="form-group">
                                <label for="">Keywords: 70 kí tự</label>
                                <input type="text" class="form-control" placeholder="Nhập các từ khóa cho SEO" name="meta_keywords" value="{{ $video->meta_keyword }}">
                            </div>
                            <div class="form-group">
                                <label for="">Description: 160 kí tự</label>
                                <textarea id="" cols="30" rows="5" class="form-control" name="meta_description">{{ $video->meta_desc }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

