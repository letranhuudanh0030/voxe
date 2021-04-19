<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
            <!-- User Info-->
            <div class="sidenav-header-inner text-center"><img src="{{ asset('admin_source/img/user/admin-button-icon-hi.png') }}" alt="person"
                    class="img-fluid rounded-circle">
                <h2 class="h5">{{ Auth::user()->name }}</h2><span class="text-warning"><i class="fa fa-check-circle text-warning"></i>Online</span>
            </div>
            <!-- Small Brand information, appears on minimized sidebar-->
            <div class="sidenav-header-logo"><a href="void:javascript(0)" class="brand-small text-center"><strong>N</strong><strong class="text-primary">B</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu" id="accordionExample">
            {{-- <h5 class="sidenav-heading">Main</h5> --}}
            <ul id="side-main-menu" class="side-menu list-unstyled">
                @php
                    $i = 0
                @endphp
                @foreach (config('variables.menu') as $key => $menus )
                    @if ($menus['submenu'])
                        <li class="nb-list-group list-group-{{ $i++ }}">
                            <a href="void:javascript(0)" data-toggle="collapse" data-target="#{{ $key }}" aria-expanded=@if ($menus['url'] == request()->segment(2))
                                "true"
                            @else
                                "false"
                            @endif aria-controls="{{ $key }}" style="text-transform:capitalize" class="nb-link"><i class="fa {{ $menus['icon'] }}" aria-hidden="true"></i>{{ str_replace('_', ' ',$key) }}</a>
                            <ul id="{{ $key }}" class="collapse list-unstyled nb-sub @if ($menus['url'] == request()->segment(2))
                                show
                            @endif" aria-labelledby="headingOne" data-parent="#accordionExample">

                                @foreach ($menus['submenu'] as $name => $url)
                                    <li class="nb-list-item {{ Request::is($url) ? 'active' : '' }}"><a href="{{ url($url) }}" style="text-transform:capitalize">{{ $name }}</a></li>
                                @endforeach

                            </ul>
                        </li>
                    @else
                        <li class="nb-list-group {{ Request::is($menus['url']) ? 'active' : '' }}">
                            <a href="{{ url($menus['url']) }}" style="text-transform:capitalize"> <i class="fa {{ $menus['icon'] }}"></i>{{ str_replace('_', ' ',$key) }}</a>
                        </li>
                    @endif

                @endforeach
            </ul>
        </div>
        <div class="admin-menu text-center">
            <hr style="background:white">
            <h5 class="sidenav-heading">Hỗ trợ cập nhật</h5>
            <h5>~~~HOTLINE~~~</h5>
            <span class="text-glowing"> 08.3 916 5534</span>
            <h5>~~~EMAIL~~~</h5>
            <p>datanambo@gmail.com</p>
            <p>capnhat.nambo@gmail.com</p>
        </div>
    </div>
</nav>
