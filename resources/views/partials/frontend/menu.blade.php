<!-- The menu -->
<section id="menu-nav" class="clearfix">
    <div class="container-fluid">
        <div class="row menu--bg">
            <div class="col-12 mx-auto">
                <nav id="menu">
                    <ul class="menu-lv1">
                        @foreach ($menus as $menu)   
                            @if ($menu->location_id == '1')              
                                <li class="menu-lv1__item li-all">
                                    <a href="{{ $menu->url ? url($menu->url) == url('/') ? url($menu->url) : url($menu->url).'.html' : 'void:javascript(0)' }}" class="menu-lv1__item--link a-all">{{ $menu->title }}</a>
                                    @if ($menu->module && $menu->module_item == 'child_category')
                                        <ul class="menu-lv2 ul-all">
                                            @php
                                                $moduleMenu = null;
                                                if($menu->module == 'article_catalogua'){
                                                    $moduleMenu = $articleCate;
                                                } else {
                                                    $moduleMenu = $productCate;
                                                }
                                            @endphp
                                            @if ($menu->module_item != null)
                                                @foreach ($moduleMenu->where('id', $menu->module_id) as $submenu)
                                                    @if ($menu->module_item == 'article')
                                                    @elseif($menu->module_item == 'product')
                                                    @else
                                                        @foreach ($moduleMenu->where('parent_id', $menu->module_id)->sortByDesc('sort_order') as $submenu)
                                                            <li class="menu-lv2__item li-all">
                                                                <a href="{{ $menu->module == 'product_catalogua' ? route('categoryP', ['slug' => $submenu->slug, 'id'=>$submenu->id]) : route('categoryA', ['slug' => $submenu->slug, 'id'=>$submenu->id])}}" class="menu-lv2__item--link a-all">{{ $submenu->name }}</a>
                                                                @if ($moduleMenu->where('parent_id', $submenu->id)->count() > 0)
                                                                    <ul class="menu-lv3 ul-all">
                                                                        @foreach ($moduleMenu->where('parent_id', $submenu->id)->sortByDesc('sort_order') as $submenu2)
                                                                            <li class="menu-lv3__item li-all">
                                                                                <a href="{{ $menu->module == 'product_catalogua' ? route('categoryP', ['slug' => $submenu2->slug, 'id'=>$submenu2->id]) : route('categoryA', ['slug' => $submenu2->slug, 'id'=>$submenu2->id])}}" class="menu-lv3__item--link a-all">{{ $submenu2->name }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                        <li class="search align-self-center">
                            <form action="{{ route('search') }}" method="GET">
                                @csrf
                                <input type="text" class="search__input" placeholder="Tìm kiếm" name="keyword">
                                <button class="search__btn" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="d-flex d-lg-none menu--bg">
        <a href="#menu" class="btn-menu-mobile mr-auto"></a>
        <div class="align-self-center search-mobile">
            <input type="text" class="search-mobile__input" placeholder="Tìm kiếm">
            <button class="search-mobile__btn">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </div>
        {{-- <div class="align-self-center cart-mobile">
            <a href="" class="">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <b>0</b>
            </a>           
        </div> --}}
    </div>
</section>