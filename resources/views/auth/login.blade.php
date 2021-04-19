@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 8%;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <h5 class="card-header text-uppercase font-weight-bold">đăng nhập hệ thống</h5>

                <div class="card-body">
                    <div class="row p-3">
                        <div class="col-6">
                            <div class="login-support">
                                <p class="text-uppercase">chăm sóc khách hàng</p>
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <img src="{{ asset('images/call-24h.jpg') }}" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-8 align-self-center">
                                        <span>Điện thoại: 028.3916.5534</span><br>
                                        <span>Email:datanambo@gmail.com capnhat.nambo@gmail.com</span><br>

                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="login-contact">
                                <p class="text-uppercase">hãy liên lạc ngay với chúng tôi khi bạn cần tư vấn</p>
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <img src="{{ asset('images/logo.jpg') }}" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-8">
                                        <span style="color:orange">CÔNG TY TNHH TƯ VẤN ĐẦU TƯ NAM BỘ VN</span><br>
                                        <span>Địa chỉ: 533/15A Lê Văn Thọ,Phường 14, Quận Gò Vấp</span><br>
                                        <span>Điện thoại: 028.3916 5534 </span><br>
                                        <span>Email: datanambo@gmail.com</span><br>
                                        <span>Website: websitenambo.com</span><br>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="col-6 border-login">

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="email" class="col-form-label text-md-right">Tài khoản Email:</label>

                                    <div class="">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="password" class=" col-form-label text-md-right">Mật khẩu:</label>

                                    <div class="">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="form-group">
                                    <label for="">Mã kiểm tra:</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="border-captcha">
                                                @php
                                                    $captcha = rand(00000 ,99999);
                                                    Session::flash('captcha', $captcha);
                                                @endphp
                                                <p>{{ Session::get('captcha') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <input type="number" name="captcha" id="" class="form-control" required>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                Ghi nhớ tài khoản này
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ url('') }}" class="float-right text-uppercase text-decoration-none text-dark"><i class="fa fa-home mr-1"></i>Trang chủ</a>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary text-uppercase btn-lg">
                                            đăng nhập
                                        </button>

                                        {{-- @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
