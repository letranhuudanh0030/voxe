<section id="nb-header-content">
    <div class="row bg-header">
        <div class="col-6 align-self-center">
            <h1 class="title-header d-inline-block">{{ $title_page }}</h1>
        </div>

        @if (Route::currentRouteName() != 'image-manager' && request()->segment(2) != 'config')
            @if (Route::currentRouteName() != 'tag' && Route::currentRouteName() != 'color' && Route::currentRouteName() != 'size' )
                <div class="col-6 align-self-center">
                    <a href="{{ route($create_page)}}" class="btn btn-success float-right mr-4"><i class="fa fa-plus-square fa-lg mr-2"></i>Thêm mới</a>
                    <a href="{{ route($list_page) }}" class="btn btn-primary float-right mr-4"><i class="fa fa-outdent fa-lg mr-2"></i>Danh sách</a>
                </div>
            @endif
        @else

            <div class="col-6 align-self-center">
                <div class="mr-4">
                    <a href="{{ route('config') }}" class="btn btn-secondary float-right nb-config mr-2">Cấu hình chung</a>
                    <a href="{{ route('config.display') }}" class="btn btn-secondary float-right mr-2 nb-config">Giao diện</a>
                    <a href="{{ route('config.contact') }}" class="btn btn-secondary float-right mr-2 nb-config">Liên hệ</a>
                    <a href="{{ route('config.social') }}" class="btn btn-secondary float-right mr-2 nb-config">Mạng xã hội</a>
                    <a href="{{ route('config.language') }}" class="btn btn-secondary float-right mr-2 nb-config">Ngôn ngữ</a>
                </div>
            </div>

        @endif
    </div>
</section>
