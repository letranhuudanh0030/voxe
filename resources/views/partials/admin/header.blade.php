<header class="header">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <div class="navbar-header">
                    <a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a>
                    <a href="{{ route('dashboard') }}" class="navbar-brand">
                        <div class="brand-text d-none d-md-inline-block">
                            <strong>Nam Bộ VN</strong>
                            <span class="text-primary"></span>
                        </div>
                    </a>
                    <div class="quick-add">
                        <button class="btn btn-light cta-quick-add"><i class="fa fa-plus-circle fa-lg"></i>&nbsp;Thêm nhanh</button>
                        <ul class="quick-add-list list-group">
                            @foreach (config('variables.add_quick') as $key => $item)
                                <li class="quick-add-item list-group-item"><a href="{{ route($item['url']) }}"><i class="{{ $item['icon'] }} mr-1"></i> {{ $item['title'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

                    <a href="{{ route('image-manager') }}" class="btn btn-light text-dark mr-4 font-weight-bold" style="text-transform: uppercase"><i class="fa fa-folder-open fa-lg mr-2"></i>Quản lý hình ảnh</a>
                    <a href="{{ route('config') }}" class="btn btn-light text-dark mr-4 font-weight-bold" style="text-transform: uppercase"><i class="fa fa-gears fa-lg mr-2"></i>Cấu hình</a>

                    {{-- <li class="nav-item dropdown">
                        <a id="languages" rel="nofollow" data-target="#" href="#"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="nav-link language dropdown-toggle">
                            @if (app()->getLocale() == config('app.available_locales')[0])

                            <img src="{{ asset('admin/img/flags/16/GB.png') }}" alt="language"><span class="d-none d-sm-inline-block">{{ strtoupper('en') }}</span>
                            @else
                            <img src="{{ asset('admin/img/flags/16/VN.png') }}" alt="language"><span class="d-none d-sm-inline-block">{{ strtoupper('vi') }}</span>
                            @endif

                        </a>
                        <ul aria-labelledby="languages" class="dropdown-menu">

                            @foreach (config('app.available_locales') as $locale)

                            <li>
                                <a rel="nofollow" href="{{ route(Route::currentRouteName(), $locale) }}" class="dropdown-item">
                                    <img src="@if($locale == 'en')
                                            {{ asset('admin/img/flags/16/GB.png') }}
                                            @else
                                            {{ asset('admin/img/flags/16/VN.png') }}
                                            @endif
                                    " alt="language" class="mr-2">
                                    <span>
                                        @if ($locale == 'en')
                                            {{ strtoupper('english') }}
                                        @else
                                            {{ strtoupper('vietnamese') }}
                                        @endif
                                    </span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('user.edit', Auth::user()->id) }}" class="nav-link logout">
                            <span class="d-none d-sm-inline-block">{{ Auth::user()->name }}</span><i class="fa fa-info-circle"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link logout">
                            <span class="d-none d-sm-inline-block">Xem trang</span><i class="fa fa-globe"></i>
                        </a>
                    </li>
                    <!-- Log out-->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                             <span class="d-none d-sm-inline-block mr-1">Đăng xuất</span><i class="fa fa-sign-out"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf

                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>
