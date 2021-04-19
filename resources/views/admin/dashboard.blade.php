@extends('layouts.master')
@section('content')
<section id="nb-header-content">
    <div class="row">
        <div class="col-12 bg-header">
            <h1 class="title-header">nam bộ vn</h1>
        </div>
    </div>
</section>
<section id="nb-content">
    <div class="container-fluid">
        <div class="nb-welcome">
            <div class="nb-border-check">
                <i class="fa fa-check-circle fa-lg nb-color-check-welcome"></i>
            </div>
            Chào mừng bạn đến với chương trình quản lí website !!
        </div>
        <hr>
        <div class="row">
            <div class="col-12 ">
                <div class="row">
                    <div class="col-2 text-center">
                        <div class="nb-dashboard-count-title">
                            <a href="#">
                                <div class="nb-dashboard-count-circle background-green">
                                    <i class="fa fa-shopping-cart nb-dashboard-count-icon"></i>
                                </div>
                            </a>
                        </div>
                        <div class="nb-dashboard-count-content background-green">
                            <p class="nb-dashboard-count-content-text">Sản phẩm</p>
                            <p class="nb-dashboard-count-content-number">{{ $count_product }}</p>
                            <a href="{{ route('products.index') }}" class="nb-dashboard-count-content-cta">Xem thêm <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-2 text-center">
                        <div class="nb-dashboard-count-title">
                            <a href="#">
                                <div class="nb-dashboard-count-circle background-blue-strong">
                                    <i class="fa fa-shopping-cart nb-dashboard-count-icon"></i>
                                </div>
                            </a>
                        </div>
                        <div class="nb-dashboard-count-content background-blue-strong">
                            <p class="nb-dashboard-count-content-text">danh mục sản phẩm</p>
                            <p class="nb-dashboard-count-content-number">{{ $count_category_product }}</p>
                            <a href="{{ route('product-type.index') }}" class="nb-dashboard-count-content-cta">Xem thêm <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-2 text-center">
                        <div class="nb-dashboard-count-title">
                            <a href="#">
                                <div class="nb-dashboard-count-circle background-blue">
                                    <i class="fa fa-pencil-square-o nb-dashboard-count-icon"></i>
                                </div>
                            </a>
                        </div>
                        <div class="nb-dashboard-count-content background-blue">
                            <p class="nb-dashboard-count-content-text">bài viết</p>
                            <p class="nb-dashboard-count-content-number">{{ $count_article }}</p>
                            <a href="{{ route('post.index') }}" class="nb-dashboard-count-content-cta">Xem thêm <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-2 text-center">
                        <div class="nb-dashboard-count-title">
                            <a href="#">
                                <div class="nb-dashboard-count-circle background-yellow">
                                    <i class="fa fa-picture-o nb-dashboard-count-icon"></i>
                                </div>
                            </a>
                        </div>
                        <div class="nb-dashboard-count-content background-yellow">
                            <p class="nb-dashboard-count-content-text">ảnh slide</p>
                            <p class="nb-dashboard-count-content-number">{{ $count_slide }}</p>
                            <a href="{{ route('slides.index') }}" class="nb-dashboard-count-content-cta">Xem thêm <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-2 text-center">
                        <div class="nb-dashboard-count-title">
                            <a href="#">
                                <div class="nb-dashboard-count-circle background-red">
                                    <i class="fa fa-users nb-dashboard-count-icon"></i>
                                </div>
                            </a>
                        </div>
                        <div class="nb-dashboard-count-content background-red">
                            <p class="nb-dashboard-count-content-text">đối tác</p>
                            <p class="nb-dashboard-count-content-number">{{ $count_partner }}</p>
                            <a href="{{ route('partners.index') }}" class="nb-dashboard-count-content-cta">Xem thêm <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-2 text-center">
                        <div class="nb-dashboard-count-title">
                            <a href="#">
                                <div class="nb-dashboard-count-circle background-violet">
                                    <i class="fa fa-film nb-dashboard-count-icon"></i>
                                </div>
                            </a>
                        </div>
                        <div class="nb-dashboard-count-content background-violet">
                            <p class="nb-dashboard-count-content-text">video</p>
                            <p class="nb-dashboard-count-content-number">{{ $count_video }}</p>
                            <a href="{{ route('videos.index') }}" class="nb-dashboard-count-content-cta">Xem thêm <i class="fa fa-chevron-circle-right"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
