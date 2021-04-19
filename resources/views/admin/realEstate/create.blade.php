@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')

<section id="real_estate">
    <div class="container-fluid mt-3">
        <form action="{{ route('estate.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-info-circle"></i> Thông tin chung
                        </div>
                        <div class="card-body">
                            <div class="form-content mt-4">
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Tiêu đề<span class="text-danger">(*)</span>:</label>
                                    <div class="col-sm-10 mb-3">
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                                        <span class="text-small text-gray help-block-none">Nhập tiêu đề (bắt buộc).</span>
                                    </div>
                                </div>
                            </div>     
                            
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Địa chỉ<span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10 mb-3">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="">Vùng miền:</label>
                                            <select name="region_code" id="region" class="form-control">
                                                @foreach (config('variables.region') as $key => $region)
                                                    <option value="{{ $key }}">{{ $region }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="">Thành phố:</label>
                                            <select name="city_code" id="city" class="form-control">
                                                <option value="">-- Chọn thành phố --</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="">Quận/Huyện:</label>
                                            <select name="district_code" id="district" class="form-control">
                                                <option value="">-- Chọn quận/huyện --</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="0">Phường/Xã:</label>
                                            <select name="ward_code" id="ward" class="form-control">
                                                <option value="">-- Chọn phường/xã --</option>    
                                            </select>   
                                        </div>   
                                    </div>
                                    <span class="text-small text-gray help-block-none">Chọn các thông tin địa chỉ (bắt buộc).</span>
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
                                    <div class="product-imgs"></div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Thông tin liên lạc: <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10 mb-3">
                                    <textarea name="contact" id="contact" class="form-control config_content">{{ old('contact') }}</textarea>
                                    <span class="text-small text-gray help-block-none">Nhập thông tin liên lạc.</span>
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Chọn loại bất động sản <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10 mb-3">
                                    <select class="form-control choose-estate" name="type_spec">
                                        @forelse (config('variables.choose_form_estate') as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @empty
                                            There are no subcategories
                                        @endforelse                                        
                                    </select>
                                    <span class="text-small text-danger help-block-none">Chọn loại bất động sản để hiển thị khung nhập theo thể loại (bắt buộc).</span>
                                </div>
                            </div>
                            <hr>
                            
                            {{-- Begin form đất công nghiệp --}}
                            <div class="form-dcn" style="display: none">
                                <h3 class="text-uppercase font-weight-bold text-primary text-center">== Đất công nghiệp ==</h3>                               
                                <div class="form-content mt-4">
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Danh mục<span class="text-danger">(*)</span>:</label>
                                        <div class="col-sm-10 mb-3">
                                            <select size="5" class="form-control" name="product_category_id" id="cate_dcn">
                                                <option value="" selected>-- Chọn danh mục --</option>

                                                @if ($productCategories)
                                                    {{ showCategories($productCategories,null, $cate_dcn->id) }}
                                                @else
                                                    There are no subcategories
                                                @endif
                                            </select>
                                            <span class="text-small text-gray help-block-none">Chọn danh mục (bắt buộc).</span>
                                        </div>
                                    </div>                                   

                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Giá thuê:</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-8">
                                                    <input type="number" class="form-control price" name="price" value="{{ old('price', 0) }}" placeholder="Nhập giá tiền.">
                                                    <span class="text-small text-gray help-block-none">Viết liền, không dấu cách ( giá trị = 0 được xem là hình thức thương lượng ).</span>
                
                                                    <input type="text" class="form-control price-format" name="price_format" value="{{ old('price_format') }}" placeholder="0" disabled>
                                                    <span class="text-small text-gray help-block-none">Số tiền bằng sô.</span>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                      <select class="form-control" name="currency" id="price_unit">
                                                        <option value="0">-- Chọn đơn vị tiền tệ --</option>
                                                        @foreach (config('variables.price_unit') as $key => $unit)
                                                            <option value="{{ $key }}">{{ $unit }}</option>
                                                        @endforeach
                                                      </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Diện tích:</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-8">
                                                    <input type="number" class="form-control" name="acreage" value="{{ old('acreage', 0) }}" placeholder="Nhập diện tích.">
                                                    <span class="text-small text-gray help-block-none">Viết liền, không dấu cách ( giá trị = 0 được xem là chưa xác định ).</span>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                               
                                                      <select class="form-control" name="unit_area" id="acreage_unit">
                                                          <option value="0">-- Chọn đơn vị diện tích --</option>
                                                        @foreach (config('variables.acreage_unit') as $key => $unit)
                                                            <option value="{{ $key }}">{{ $unit }}</option>
                                                        @endforeach
                                                      </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Mô tả nhà xưởng: <span class="text-danger">(*)</span>:</label>
                                        <div class="col-sm-10 mb-3">
                                            <textarea name="description" id="description" class="form-control config_content">{{ old('description') }}</textarea>
                                            <span class="text-small text-gray help-block-none">Nhập thông tin mô tả.</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Điều kiện: <span class="text-danger">(*)</span>:</label>
                                        <div class="col-sm-10 mb-3">
                                            <textarea name="condition" id="condition" class="form-control config_content">{{ old('condition') }}</textarea>
                                            <span class="text-small text-gray help-block-none">Nhập thông tin điều kiện.</span>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                            {{-- End form đất công nghiệp --}}

                            {{-- Begin form nhà xưởng, nhà kho --}}
                            <div class="form-nxnk" style="display: none">
                                <h3 class="text-uppercase font-weight-bold text-primary text-center">== Nhà xưởng, nhà kho ==</h3>                               
                                <div class="form-content mt-4">
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Danh mục<span class="text-danger">(*)</span>:</label>
                                        <div class="col-sm-10 mb-3">
                                            <select size="5" class="form-control" name="product_category_id" id="cate_nxnk">
                                                <option value="" selected>--Chọn--</option>

                                                @if ($productCategories)
                                                    {{ showCategories($productCategories,null, $cate_nxnk->id) }}
                                                @else
                                                    There are no subcategories
                                                @endif
                                            </select>
                                            <span class="text-small text-gray help-block-none">Chọn danh mục (bắt buộc).</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Phân khu chức năng: <span class="text-danger">(*)</span>:</label>
                                        <div class="col-sm-10 mb-3">
                                            <textarea name="functional_subdivision" id="functional_subdivision" class="form-control config_content">{{ old('functional_subdivision') }}</textarea>
                                            <span class="text-small text-gray help-block-none">Nhập thông tin phân khu chức năng.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Hạ tầng: <span class="text-danger">(*)</span>:</label>
                                        <div class="col-sm-10 mb-3">
                                            <textarea name="infrastructure" id="infrastructure" class="form-control config_content">{{ old('infrastructure') }}</textarea>
                                            <span class="text-small text-gray help-block-none">Nhập thông tin Hạ tầng.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Chi phí đầu tư: <span class="text-danger">(*)</span>:</label>
                                        <div class="col-sm-10 mb-3">
                                            <textarea name="investment_costs" id="investment_costs" class="form-control config_content">{{ old('investment_costs') }}</textarea>
                                            <span class="text-small text-gray help-block-none">Nhập thông tin Chi phí đầu tư.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Ngành nghề: <span class="text-danger">(*)</span>:</label>
                                        <div class="col-sm-10 mb-3">
                                            <textarea name="career" id="career" class="form-control config_content">{{ old('career') }}</textarea>
                                            <span class="text-small text-gray help-block-none">Nhập thông tin Ngành nghề.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Chính sách ưu đãi đầu tư: <span class="text-danger">(*)</span>:</label>
                                        <div class="col-sm-10 mb-3">
                                            <textarea name="incentives" id="incentives" class="form-control config_content">{{ old('incentives') }}</textarea>
                                            <span class="text-small text-gray help-block-none">Nhập thông tin Chính sách ưu đãi đầu tư.</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-control-label">Hỗ trợ khách hàng: <span class="text-danger">(*)</span>:</label>
                                        <div class="col-sm-10 mb-3">
                                            <textarea name="suport" id="suport" class="form-control config_content">{{ old('suport') }}</textarea>
                                            <span class="text-small text-gray help-block-none">Nhập thông tin Hỗ trợ KH.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End form nhà xưởng, nhà kho --}}
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Thao tác</label>
                                <div class="col-sm-10 mb-3">
                                    @include('partials.admin.button')
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
                            @include('partials.admin.options')
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-thumbs-o-up fa-lg"></i> Meta
                        </div>
                        <div class="card-body">
                            @include('partials.admin.seo')
                        </div>
                    </div>
                </div>
                {{-- <div class="col-12">
                    @include('partials.admin.button')
                </div> --}}
            </div>
            @include('partials.admin.modal_estate_trans')
        </form>
    </div>
</section>
<!-- Modal -->
@include('partials.admin.modal_gallery')

<script>
    $(function(){


        console.log($('choose-estate').val())
        if($('choose-estate').val() == undefined){
            $('.trans').prop('disabled', true)
        } else {
            $('.trans').prop('disabled', false)
        }

        $('.trans').click(function(){
            $('#categoryTrans').modal()
        })

        $('.choose-estate').change(function(){
            let selectedValue = $(this).children('option:selected').val()
            console.log(selectedValue)
            if(selectedValue == 'f-dat-cong-nghiep'){
                $('.form-dcn').css('display', 'block')
                $('.form-nxnk').css('display', 'none')
                $('#cate_dcn').prop('disabled', false)
                $('#cate_nxnk').prop('disabled', true)
                $('.trans').prop('disabled', false)
            } else if(selectedValue == 'f-nha-xuong') {
                $('.form-dcn').css('display', 'none')
                $('.form-nxnk').css('display', 'block')
                $('#cate_dcn').prop('disabled', true)
                $('#cate_nxnk').prop('disabled', false)
                $('.trans').prop('disabled', false)
            } else {
                $('.form-dcn').css('display', 'none')
                $('.form-nxnk').css('display', 'none')
                $('#cate_dcn').prop('disabled', false)
                $('#cate_nxnk').prop('disabled', false)
                $('.trans').prop('disabled', true);
            }
        })      
    })
</script>
    
@endsection
