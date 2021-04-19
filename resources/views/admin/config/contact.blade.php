@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
@if ($configContact)
    <section id="nb-config-contact">
        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-info-circle fa-lg mr-2"></i>Thông tin chung
                    <button class="btn btn-primary float-right text-decoration-none trans">
                        Ngôn ngữ
                    </button>
                </div>
                <div class="card-body">
                    <form action="{{ route('config.postcontact', $configContact->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="" class="font-weight-bold">[Liên hệ] - Footer:</label>
                            <textarea name="config_contact_footer" id="config_contact_footer" cols="30" rows="10" class="form-control config_content">{{ $configContact->footer }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="font-weight-bold">[Map] - Footer:</label>
                            <textarea name="config_work_footer" id="config_work_footer" cols="30" rows="10" class="form-control config_content">{{ $configContact->work_footer }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="font-weight-bold">[Thêm] - Footer:</label>
                            <textarea name="config_commit_footer" id="config_commit_footer" cols="30" rows="10" class="form-control config_content">{{ $configContact->commit_footer }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="font-weight-bold">[Liên hệ] - Trang liên hệ:</label>
                            <textarea name="config_contact_page" id="config_contact_page" cols="30" rows="10" class="form-control config_content">{{ $configContact->contact_page }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="font-weight-bold">Hỗ trợ trực tuyến:</label>
                        <textarea name="config_content_support" id="config_content_support" cols="30" rows="10" class="form-control config_content">{{ $configContact->support }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="font-weight-bold">Email name:</label>
                            <input type="text" class="form-control" name="email_name" value="{{ $configContact->email_name }}">
                            <span class="text-small text-gray help-block-none">Nhập tiêu đề email gửi.</span>
                        </div>
                        <div class="form-group">
                            <label for="" class="font-weight-bold">Email nhận:</label>
                            <input type="text" class="form-control" name="email_receive" value="{{ $configContact->email_rece }}">
                            <span class="text-small text-gray help-block-none">Nhập email nhận liên hệ theo đúng định dạng email. Vd: abc@xxx.com.</span>
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
                        @include('partials.admin.modal_contact_trans')
                    </form>
                </div>
            </div>
        </div>
    </section>
@endif
@endsection
@section('script')
    <script>
        $(function(){
            $('.trans').click(function(){
                $('#contactTrans').modal()
            })
        })
    </script>
@endsection

