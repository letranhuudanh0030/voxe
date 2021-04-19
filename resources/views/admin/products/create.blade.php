@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')

<section id="nb-create-article">
    <div class="container-fluid mt-3">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <span class="text-small text-gray help-block-none">Nhập tên sản phẩm.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Mã sản phẩm :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="str_id" value="{{ old('str_id') }}">
                                    <span class="text-small text-gray help-block-none">Nhập mã sản phẩm.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Giá bán :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control price" name="price" value="{{ old('price', 0) }}" placeholder="Nhập giá tiền.">
                                    <span class="text-small text-gray help-block-none">Đơn vị : vnđ (viết liền, không dấu cách).</span>

                                    <input type="text" class="form-control price-format" name="price_format" value="{{ old('price_format') }}" placeholder="0" disabled>
                                    <span class="text-small text-gray help-block-none">Số tiền bằng sô.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Giá khuyến mãi :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="dis_price" value="{{ old('dis_price', 0) }}" placeholder="Nhập giá tiền khuyến mãi">
                                    <span class="text-small text-gray help-block-none">Đơn vị : vnđ (viết liền, không dấu cách). <br> Giá khuyến mãi > 100 sẽ tính theo giá gốc. <br> Giá khuyến mãi < 100 sẽ tính theo phần trăm (%).</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Danh mục <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10 mb-3">
                                    <select size="5" class="form-control" name="category_id">
                                        <option value="" selected>--Chọn--</option>
                                        @if ($productCategories)
                                            {{ showCategories($productCategories) }}
                                        @else
                                            There are no subcategories
                                        @endif
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="text-small text-gray help-block-none">Chọn danh mục sản phẩm (bắt buộc).</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Hãng sản xuất <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10 mb-3">
                                    <select size="5" class="form-control" name="brand_id">
                                        <option value="" selected>--Chọn--</option>
                                        @if ($brands)
                                            {{ showCategories($brands) }}
                                        @else
                                            There are no subcategories
                                        @endif
                                    </select>
                                    @error('brand_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="text-small text-gray help-block-none">Chọn hãng sản xuất sản phẩm (bắt buộc)</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Hình đại diện:</label>
                                <div class="col-sm-10 mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="avatar_image" name="avatar_image" readonly value="{{ old('avatar_image') }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary browser2" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='avatar_image'>Browser</button>
                                        </div>
                                    </div>
                                    <span class="text-small text-gray help-block-none">Chọn hình đại diện của sản phẩm.</span>
                                    <br>
                                    <img src="{{ asset(old('avatar_image')) }}" alt="" class="img-fluid avatar-img" width="100px" height="100px">
                                </div>
                            </div>


                            {{-- thêm nhiều hình --}}
                            {{-- <div class="form-group row nb-images">
                                <label class="col-sm-2 form-control-label">Thêm hình khác: </label>
                                <div class="col-sm-10 mb-3">
                                    <button class="btn btn-primary add-more-img" type="button">Thêm hình sản phẩm</button>
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Hình khác:</label>
                                <div class="col-sm-10 mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="images" name="images" readonly value="{{ old('images') }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary browser_images" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='images'>Browser</button>
                                        </div>
                                    </div>
                                    <span class="text-small text-gray help-block-none">Có thể chọn nhiều hình của sản phẩm.</span>
                                    <br>
                                    {{-- <img src="{{ asset(old('images')) }}" alt="" class="img-fluid avatar-img" width="100px" height="100px"> --}}
                                    <div class="product-imgs">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Mô tả ngắn <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10 mb-3">
                                    <textarea id="short-desc" cols="30" rows="10" class="form-control" name="short_desc">{{ old('short_desc', 'Đang cập nhật') }}</textarea>
                                    @error('short_desc')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Nội dung <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10 mb-3">
                                    <textarea id="content" cols="30" rows="10" class="form-control" name="content">{{ old('content', 'Đang cập nhật') }}</textarea>
                                    @error('content')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                    <label class="form-control-label">Tiêu biểu:</label>
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
                                    <label class="form-control-label">Mới nhất:</label>
                                </div>
                                <div>

                                    <div class="form-check-inline mb-1">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="lastest" value="0" checked>
                                            <span class="bg-secondary nb-check text-white">Không</span>
                                        </label>
                                    </div>
                                    <div class="form-check-inline mb-1">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="lastest" value="1">
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

                    <div class="card d-none">
                        <div class="card-header">
                            <i class="fa fa-gears fa-lg"></i> Màu sắc
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                @foreach ($colors as $i => $color)
                                    <div class="round form-check-inline">
                                    <input type="checkbox" id="checkbox-{{ $color->id }}" name="color[]" value="{{ $color->id }}"/>
                                        <label for="checkbox-{{ $color->id }}" style="background-color: {{ $color->code }}"></label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-gears fa-lg"></i> Size
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                @foreach ($sizes as $i => $size)
                                    <div class="form-check form-check-inline" style="background: #3490dc;
                                    padding: 5px 10px;
                                    border-radius: 10px;
                                    color: #FFF;
                                    margin: 2px">
                                        <input class="form-check-input" type="checkbox" id="{{ $size->id }}" value="{{ $size->id }}" name="size[]">
                                        <label class="form-check-label" for="{{ $size->id }}">{{ $size->title }}</label>
                                    </div>
                                @endforeach
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
                                <label for="">Slug:</label>
                                <input type="text" class="form-control" placeholder="Nhập link slug (nếu có)" name="slug" value="{{ old('slug') }}">
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
            @include('partials.admin.modal_product_trans')
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

            // images
            var index = 0;
            $('.add-more-img').click(function(){
                let formUpload = '';
                formUpload += '<div class="form-group row form-upload-'+index+' nb-image">'
                formUpload += '<label class="col-sm-2 form-control-label">Thêm hình số '+(index + 1)+': </label>'
                formUpload += '<div class="col-sm-10 mb-3">'
                formUpload += '<div class="row">'

                formUpload += '<div class="col-8">'
                formUpload += '<div class="input-group">'
                formUpload += '<input type="text" class="form-control" id="images-'+index+'" name="images[]" readonly>'
                formUpload += '<div class="input-group-append">'
                formUpload += '<button type="button" class="btn btn-primary browser-img-'+index+'" data-toggle="modal" data-target="#modal-file" type="button" data-name-type="images-'+index+'">Browser</button>'
                formUpload += '</div>'
                formUpload += '</div>'
                formUpload += '</div>'

                formUpload += '<div class="col-4">'
                formUpload += '<button class="btn btn-danger remove-img-'+index+'" type="button">Hủy</button>'
                formUpload += '</div>'

                formUpload += '</div>'
                formUpload += '</div>'
                formUpload += '</div>'
                index++
                $('.nb-images').before(formUpload)

                for (let i = 0; i < index; i++) {
                    if($('.form-upload-'+i).length){
                        $('.remove-img-'+i).click(function(){
                            $('.form-upload-'+i).remove()
                        })
                    }

                    $('.browser-img-'+i).click(function(){
                        var input_id = $('.browser-img-'+i).attr('data-name-type');
                        $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input_id+'&akey='+akey+'") !!}');
                    })
                }
            })
        });
    </script>
@endsection
