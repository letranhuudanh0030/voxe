@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
<link rel="stylesheet" href="{{ asset('admin_source/colorPicker/light.min.css') }}">
@if ($display)
          <section id="nb-config-display">
            <div class="container-fluid mt-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-info-circle fa-lg mr-2"></i>Thông tin chung
                    </div>
                    <div class="card-body">
                        <form action="{{ route('config.postdisplay', $display->id) }}" method="POST">
                            @csrf

                            <div class="nb-block-1">
                                <h3>Header</h3>
                                <hr>
                                <div class="form-group">
                                    <label class="col-sm-5 form-control-label">Hình background header:</label>
                                    <div class="col-sm-5 mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="header_image" name="header_image" readonly width="50%" value="{{ $display->header_image }}">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary browser" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='header_image'>Browser</button>
                                            </div>
                                        </div>
                                        <span class="text-small text-gray help-block-none">Chọn hình background cho website.</span>
                                        <br>
                                        <img src="{{ asset($display->header_image) }}" alt="" class="img-fluid header-img" width="100%" height="100px">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-5 form-control-label">Hình favicon:</label>
                                    <div class="col-sm-5 mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="favicon" name="favicon" readonly width="50%" value="{{ $display->favicon }}">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary browser2" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='favicon'>Browser</button>
                                            </div>
                                        </div>
                                        <span class="text-small text-gray help-block-none">Chọn hình favicon cho website.</span>
                                        <br>
                                        <img src="{{ asset($display->favicon) }}" alt="" class="img-fluid favicon-img" width="100px" height="100px">
                                    </div>
                                </div>
                            </div>

                            <div class="nb-block-page">
                                <h3>Banner trang</h3>
                                <hr>
                                <div class="form-group">
                                    <label class="col-sm-5 form-control-label">Hình đồng hồ:</label>
                                    <div class="col-sm-5 mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="clock-banner" name="clock_banner" readonly width="50%" value="{{ $display->banner_clock }}">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary browser-clock-banner" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='clock-banner'>Browser</button>
                                            </div>
                                        </div>
                                        <span class="text-small text-gray help-block-none">Chọn hình clock-banner cho website.</span>
                                        <br>
                                        <img src="{{ asset($display->banner_clock) }}" alt="" class="img-fluid clock-banner-img" width="100px" height="100px">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 form-control-label">Hình banner trang:</label>
                                    <div class="col-sm-5 mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="page-banner" name="page_banner" readonly width="50%" value="{{ $display->banner_page }}">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary browser-page-banner" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='page-banner'>Browser</button>
                                            </div>
                                        </div>
                                        <span class="text-small text-gray help-block-none">Chọn hình page-banner cho website.</span>
                                        <br>
                                        <img src="{{ asset($display->banner_page) }}" alt="" class="img-fluid page-banner-img" width="100px" height="100px">
                                    </div>
                                </div>
                            </div>




                            <div class="nb-block-color d-none">
                                <h3>Màu sắc</h3>
                                <hr>
                                <div class="row">

                                    <div class="nb-menu-color  col-sm-4">
                                        <h4>Menu</h4>
                                        <hr>
                                        <div class="form-group">
                                            <label for="dc-ex4">Màu nền menu (menu background): </label>
                                            <span class="colorpicker-input colorpicker-input--position-left">
                                                <input id="menu-bg" type="text" class="form-control colorpicker-anchor" style="width:40%" name="menu_bg">
                                                <span id="dc-ex4-anchor" class="colorpicker-custom-anchor colorpicker-circle-anchor">
                                                    <span data-color="" class="colorpicker-circle-anchor__color">
                                                    </span>
                                                </span>
                                            </span>
                                            <small class="form-text text-muted">Định dạng: <code>rgba</code></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="dc-ex4">Màu hover nền menu (menu background hover): </label>
                                            <span class="colorpicker-input colorpicker-input--position-left">
                                                <input id="menu-bg-hover" type="text" class="form-control colorpicker-anchor" style="width:40%" name="menu_bg_hover">
                                                <span id="dc-ex4-anchor" class="colorpicker-custom-anchor colorpicker-circle-anchor">
                                                    <span data-color="" class="colorpicker-circle-anchor__color">
                                                    </span>
                                                </span>
                                            </span>
                                            <small class="form-text text-muted">Định dạng: <code>rgba</code></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="dc-ex4">Màu chữ menu (menu color): </label>
                                            <span class="colorpicker-input colorpicker-input--position-left">
                                                <input id="menu-color" type="text" class="form-control colorpicker-anchor" style="width:40%" name="menu_color">
                                                <span id="dc-ex4-anchor" class="colorpicker-custom-anchor colorpicker-circle-anchor">
                                                    <span data-color="" class="colorpicker-circle-anchor__color">
                                                    </span>
                                                </span>
                                            </span>
                                            <small class="form-text text-muted">Định dạng: <code>rgba</code></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="dc-ex4">Màu hover chữ menu (menu color hover): </label>
                                            <span class="colorpicker-input colorpicker-input--position-left">
                                                <input id="menu-color-hover" type="text" class="form-control colorpicker-anchor" style="width:40%" name="menu_color_hover">
                                                <span id="dc-ex4-anchor" class="colorpicker-custom-anchor colorpicker-circle-anchor">
                                                    <span data-color="" class="colorpicker-circle-anchor__color">
                                                    </span>
                                                </span>
                                            </span>
                                            <small class="form-text text-muted">Định dạng: <code>rgba</code></small>
                                        </div>
                                    </div>

                                    <div class="nb-footer-color  col-sm-4">

                                        <h4>Footer</h4>
                                        <hr>
                                        <div class="form-group">
                                            <label for="dc-ex4">Màu nền footer (footer background): </label>
                                            <span class="colorpicker-input colorpicker-input--position-left">
                                                <input id="footer-bg" type="text" class="form-control colorpicker-anchor" style="width:40%" name="footer_bg">
                                                <span id="dc-ex4-anchor" class="colorpicker-custom-anchor colorpicker-circle-anchor">
                                                    <span data-color="" class="colorpicker-circle-anchor__color">
                                                    </span>
                                                </span>
                                            </span>
                                            <small class="form-text text-muted">Định dạng: <code>rgba</code></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="dc-ex4">Màu chữ footer (footer color): </label>
                                            <span class="colorpicker-input colorpicker-input--position-left">
                                                <input id="footer-color" type="text" class="form-control colorpicker-anchor" style="width:40%" name="footer_color">
                                                <span id="dc-ex4-anchor" class="colorpicker-custom-anchor colorpicker-circle-anchor">
                                                    <span data-color="" class="colorpicker-circle-anchor__color">
                                                    </span>
                                                </span>
                                            </span>
                                            <small class="form-text text-muted">Định dạng: <code>rgba</code></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="dc-ex4">Màu hover chữ footer (footer color hover): </label>
                                            <span class="colorpicker-input colorpicker-input--position-left">
                                                <input id="footer-color-hover" type="text" class="form-control colorpicker-anchor" style="width:40%" name="footer_color_hover">
                                                <span id="dc-ex4-anchor" class="colorpicker-custom-anchor colorpicker-circle-anchor">
                                                    <span data-color="" class="colorpicker-circle-anchor__color">
                                                    </span>
                                                </span>
                                            </span>
                                            <small class="form-text text-muted">Định dạng: <code>rgba</code></small>
                                        </div>
                                    </div>

                                    <div class="nb-copyright-color  col-sm-4">

                                        <h4>Copyright</h4>
                                        <hr>
                                        <div class="form-group">
                                            <label for="dc-ex4">Màu nền copyright (copyright background): </label>
                                            <span class="colorpicker-input colorpicker-input--position-left">
                                                <input id="copyright-bg" type="text" class="form-control colorpicker-anchor" style="width:40%" name="copyright_bg">
                                                <span id="dc-ex4-anchor" class="colorpicker-custom-anchor colorpicker-circle-anchor">
                                                    <span data-color="" class="colorpicker-circle-anchor__color">
                                                    </span>
                                                </span>
                                            </span>
                                            <small class="form-text text-muted">Định dạng: <code>rgba</code></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="dc-ex4">Màu chữ copyright (copyright color): </label>
                                            <span class="colorpicker-input colorpicker-input--position-left">
                                                <input id="copyright-color" type="text" class="form-control colorpicker-anchor" style="width:40%" name="copyright_color">
                                                <span id="dc-ex4-anchor" class="colorpicker-custom-anchor colorpicker-circle-anchor">
                                                    <span data-color="" class="colorpicker-circle-anchor__color">
                                                    </span>
                                                </span>
                                            </span>
                                            <small class="form-text text-muted">Định dạng: <code>rgba</code></small>
                                        </div>
                                    </div>
                                    
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
    @endif
    @include('partials.admin.modal_gallery')
@endsection
@section('script')
    <script src="{{ asset('admin_source/colorPicker/default-picker.min.js') }}"></script>
    <script>
        $(function () {

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

            $('.browser-clock-banner').click(function(){
                var input_id = $('.browser-clock-banner').attr('data-name-type');
                $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input_id+'&akey='+akey+'") !!}');
            })

            $('.browser-page-banner').click(function(){
                var input_id = $('.browser-page-banner').attr('data-name-type');
                $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input_id+'&akey='+akey+'") !!}');
            })

            // show image
            $('#modal-file').on('hidden.bs.modal', function (e) {
                var url_header_img = $('#header_image').val();
                var url_favicon = $('#favicon').val();
                var url_clock_banner = $('#clock-banner').val();
                var url_page_banner = $('#page-banner').val();

                $('.header-img').attr('src', url_header_img);
                $('.favicon-img').attr('src', url_favicon);
                $('.clock-banner-img').attr('src', url_clock_banner);
                $('.page-banner-img').attr('src', url_page_banner);

            });

            // Menu
            var colorPicker = new ColorPicker.Default('#menu-bg', {
                placement: "right",
                color: "{{ $color_menu[0] }}"
                // hexOnly: true
            });
            var colorPicker = new ColorPicker.Default('#menu-bg-hover', {
                placement: "right",
                // hexOnly: true
                color: "{{ $color_menu[1] }}"
            });
            var colorPicker = new ColorPicker.Default('#menu-color', {
                placement: "right",
                // hexOnly: true
                color: "{{ $color_menu[2] }}"
            });
            var colorPicker = new ColorPicker.Default('#menu-color-hover', {
                placement: "right",
                // hexOnly: true
                color: "{{ $color_menu[3] }}"
            });

            // footer
            var colorPicker = new ColorPicker.Default('#footer-bg', {
                placement: "right",
                // hexOnly: true
                color: "{{ $color_footer[0] }}"
            });
            var colorPicker = new ColorPicker.Default('#footer-color', {
                placement: "right",
                // hexOnly: true
                color: "{{ $color_footer[1] }}"
            });
            var colorPicker = new ColorPicker.Default('#footer-color-hover', {
                placement: "right",
                // hexOnly: true
                color: "{{ $color_footer[2] }}"
            });

            // copyright
            var colorPicker = new ColorPicker.Default('#copyright-bg', {
                placement: "right",
                // hexOnly: true
                color: "{{ $color_copyright[0] }}"
            });
            var colorPicker = new ColorPicker.Default('#copyright-color', {
                placement: "right",
                // hexOnly: true
                color: "{{ $color_copyright[1] }}"
            });



        });
    </script>
@endsection

