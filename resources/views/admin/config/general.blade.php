@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
    <section id="nb-config-contact">
        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-info-circle fa-lg mr-2"></i>Thông tin chung
                </div>
                <div class="card-body">
                    <form action="{{ route('config.postgeneral', $configGeneral->id) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Tên website:</label>
                            <div class="col-sm-10 mb-3">
                                <input type="text" class="form-control" style="width:40%" name="name" value="{{ $configGeneral->name }}">
                                <span class="text-small text-gray help-block-none">Nhập tên của website.</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Slogan:</label>
                            <div class="col-sm-10 mb-3">
                                <input type="text" class="form-control" style="width:40%" name="slogan" value="{{ $configGeneral->slogan }}">
                                <span class="text-small text-gray help-block-none">Nhập slogan của website.</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Meta title:</label>
                            <div class="col-sm-10 mb-3">
                                <input type="text" class="form-control" style="width:40%" name="meta_title" value="{{ $configGeneral->meta_title }}">
                                <span class="text-small text-gray help-block-none">Nhập meta title.</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Meta keyword:</label>
                            <div class="col-sm-10 mb-3">
                                <input type="text" class="form-control" style="width:40%" name="meta_keyword" value="{{ $configGeneral->meta_keyword }}">
                                <span class="text-small text-gray help-block-none">Nhập meta keyword.</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Meta description:</label>
                            <div class="col-sm-10 mb-3">
                                <textarea name="meta_desc" id="" cols="30" rows="5" class="form-control" style="width:40%">{{ $configGeneral->meta_desc }}</textarea>
                                <span class="text-small text-gray help-block-none">Nhập meta description.</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Số điện thoại:</label>
                            <div class="col-sm-10 mb-3">
                                <input type="text" class="form-control" style="width:40%" name="phone" value="{{ $configGeneral->phone }}">
                                <span class="text-small text-gray help-block-none">Nhập số điện thoại.</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Địa chỉ:</label>
                            <div class="col-sm-10 mb-3">
                                <input type="text" class="form-control" style="width:40%" name="address" value="{{ $configGeneral->address }}">
                                <span class="text-small text-gray help-block-none">Nhập địa chỉ.</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Copyright:</label>
                            <div class="col-sm-10 mb-3">
                                <input type="text" class="form-control" style="width:40%" name="copyright" value="{{ $configGeneral->copyright }}">
                                <span class="text-small text-gray help-block-none">Nhập tên bản quyền website.</span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Hình logo:</label>
                            <div class="col-sm-10 mb-3">
                                <div class="input-group" style="width:40%">
                                    <input type="text" class="form-control" id="logo" name="logo" readonly value="{{ $configGeneral->logo }}">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary browser" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='logo'>Browser</button>
                                    </div>
                                </div>
                                <span class="text-small text-gray help-block-none">Chọn hình logo của website.</span>
                                <br>
                                <img src="{{ asset($configGeneral->logo) }}" alt="" class="img-fluid logo-img" width="100px" height="100px">
                            </div>
                        </div>


                        <div class="cta-contact">
                            <div class="row">
                                <div class="col-1">
                                    <label for="" class="font-weight-bold">Thao tác: </label>
                                </div>
                                <div class="col-11">

                                    <button class="btn btn-primary text-uppercase" type="submit">Thay đổi</button>
                                    <button class="btn btn-primary text-uppercase" type="reset">Làm lại</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('partials.admin.modal_gallery')
@endsection
@section('script')
<script>
    $(function(){
        $('.browser').click(function(){
            var input_id = $('.browser').attr('data-name-type');
            $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input_id+'&akey='+akey+'") !!}');
        })

        $('#modal-file').on('hidden.bs.modal', function (e) {
                var url_logo_img = $('#logo').val();

                $('.logo-img').attr('src', url_logo_img);
            });
    })
</script>
@endsection

