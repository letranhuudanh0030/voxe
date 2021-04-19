@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
<section id="nb-create-article-category">
    <div class="container-fluid mt-3">
        <form action="{{ route('product-type.update', $productCategory->id) }}" method="POST" enctype="multipart/form-data">
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
                                <label class="col-sm-2 form-control-label">Tên danh mục <span class="text-danger">(*) :</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="{{ $productCategory->name }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="text-small text-gray help-block-none">Nhập tên danh mục sản phẩm (bắt buộc).</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Chọn danh mục :</label>
                                <div class="col-sm-10 mb-3">
                                    <select size="5" class="form-control" name="parent_id">
                                        <option value="0" selected>--Chọn--</option>
                                        @if ($productCategories)
                                            {{ showCategories($productCategories, $productCategory) }}
                                        @else
                                            There are no subcategories.
                                        @endif
                                    </select>
                                    <span class="text-small text-gray help-block-none">Chọn danh mục (Nếu không chọn mặc định sẽ là Cấp 1).</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Hình đại diện :</label>
                                <div class="col-sm-10 mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="avatar_image" name="avatar_image" readonly value="{{ $productCategory->avatar_image }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary browser2" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='avatar_image'>Browser</button>
                                        </div>
                                    </div>
                                    <span class="text-small text-gray help-block-none">Chọn hình đại diện của danh mục.</span>
                                    <br>
                                    <img src="{{ asset($productCategory->avatar_image) }}" alt="" class="img-fluid avatar-img" width="100px" height="100px">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Mô tả ngắn :</label>
                                <div class="col-sm-10 mb-3">
                                    <textarea id="short-desc" cols="30" rows="10" class="form-control" name="short_desc">{{ $productCategory->short_desc }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Quản cáo :</label>
                                <div class="col-sm-10 mb-3">
                                    <textarea id="content" cols="30" rows="10" class="form-control" name="ad_content">{{ $productCategory->ad_content }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Thao tác :</label>
                                <div class="col-sm-10 mb-3">
                                    <button class="btn btn-primary" type="submit" name="back" value="back">Thay đổi</button>
                                    <button class="btn btn-primary" type="submit" name="close" value="close">Thay đổi và đóng</button>
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
                                            <input type="radio" class="form-check-input " name="publish" value="0" @if (!$productCategory->publish)
                                                checked
                                            @endif><span class="bg-secondary nb-check text-white">Không</span>
                                        </label>
                                    </div>
                                    <div class="form-check-inline mb-1 ">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="publish" value="1" @if ($productCategory->publish)
                                            checked
                                        @endif><span class="bg-success text-white nb-check">Có</span>
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
                                            <input type="radio" class="form-check-input " name="highlight" value="0" @if (!$productCategory->highlight)
                                            checked
                                        @endif><span class="bg-secondary nb-check text-white">Không</span>
                                        </label>
                                    </div>
                                    <div class="form-check-inline mb-1">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="highlight" value="1" @if ($productCategory->highlight)
                                            checked
                                        @endif><span class="bg-success text-white nb-check">Có</span>
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
                                <input type="text" class="form-control" placeholder="Nhập tiêu đề danh mục sản phẩm" name="meta_title" value="{{ $productCategory->meta_title }}">
                            </div>
                            <div class="form-group">
                                <label for="">Slug:</label>
                                <input type="text" class="form-control" placeholder="Nhập link slug (nếu có)" name="slug" value="{{ $productCategory->slug }}">
                            </div>
                            <div class="form-group">
                                <label for="">Keywords: 70 kí tự</label>
                                <input type="text" class="form-control" placeholder="Nhập các từ khóa cho SEO" name="meta_keywords" value="{{ $productCategory->meta_keyswords }}">
                            </div>
                            <div class="form-group">
                                <label for="">Description: 160 kí tự</label>
                                <textarea id="" cols="30" rows="5" class="form-control" name="meta_description">{{ $productCategory->meta_desc }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.admin.modal_product_category_trans')
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

            // click avatar_image open filemanager
            $('.browser2').click(function(){
                var input_id2 = $('.browser2').attr('data-name-type');
                $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input_id2+'&akey='+akey+'") !!}');
            })

            // show image
            $('#modal-file').on('hidden.bs.modal', function (e) {
                var url_avatar_img = $('#avatar_image').val();

                $('.avatar-img').attr('src', url_avatar_img);

            });
        });
    </script>
@endsection
