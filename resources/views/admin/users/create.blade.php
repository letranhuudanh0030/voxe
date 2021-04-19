@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
<section id="nb-create-article">
    <div class="container-fluid mt-3">
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-info-circle"></i> Thông tin chung
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Tên <span class="text-danger"></span>:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    <span class="text-small text-gray help-block-none">Nhập tên người dùng.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Điện thoại <span class="text-danger"></span>:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="phone" placeholder="09xxxxxxxx" value="{{ old('phone') }}">
                                    <span class="text-small text-gray help-block-none">Nhập số điện thoại người dùng.</span>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Email <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email" placeholder="email@gmail.com" value="{{ old('email') }}">
                                    <span class="text-small text-gray help-block-none">Nhập email người dùng. <i class="text-danger">( tài khoản đăng nhập )</i></span>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Mật khẩu <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password">
                                    <span class="text-small text-gray help-block-none">Nhập mật khẩu.</span>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Xác nhận mật khẩu <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password_confirmation">
                                    <span class="text-small text-gray help-block-none">Nhập lại mật khẩu.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Quyền <span class="text-danger">(*)</span>:</label>
                                <div class="col-sm-10">
                                    <select name="permission" id="" class="form-control">
                                        <option value="">-- Chọn quyền --</option>
                                        <option value="0">Quản trị tổng thể</option>
                                        <option value="1">Quản trị dữ liệu</option>
                                    </select>
                                    <span class="text-small text-gray help-block-none">Chọn quyền cho thành viên.</span>
                                    @error('permission')
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
                                    <label class="form-control-label ">Trạng thái:</label>
                                </div>
                                <div>
                                    <div class="form-check-inline mb-1">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="status" value="0" checked>
                                            <span class="bg-secondary nb-check text-white">Không</span>
                                        </label>
                                    </div>
                                    <div class="form-check-inline mb-1 ">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="status" value="1">
                                            <span class="bg-success text-white nb-check">Có</span>
                                        </label>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection


