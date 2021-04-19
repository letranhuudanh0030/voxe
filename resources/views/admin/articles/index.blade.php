@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
    <section id="nb-articles">
        <div class="container-fluid mt-4">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr class="table-info text-center">
                        <th scope="col">@sortablelink('id', 'Mã')</th>
                        <th scope="col">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check-all">
                                <label class="custom-control-label" for="check-all"></label>
                            </div>
                        </th>
                        <th scope="col">@sortablelink('title', 'Bài viết')</th>
                        <th scope="col">Danh mục</th>
                        <!--<th scope="col">Gửi email</th>-->
                        <th scope="col">@sortablelink('sort_order', 'Vị trí')</th>
                        <th scope="col">@sortablelink('created_at', 'Ngày tạo')</th>
                        <th scope="col">Hình</th>
                        <th scope="col">Hiển thị</th>
                        <th scope="col">Tiêu biểu</th>
                        <th scope="col">Mới nhất</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $key => $article)
                        <tr class="text-center nb-tr-{{ $article->id }}" data-url="{{ route('post.status') }}">

                            <td>{{ $article->id }}</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check-{{ $key }}" data-id="{{ $article->id }}">
                                    <label class="custom-control-label" for="check-{{ $key }}"></label>
                                </div>
                            </td>
                            <td class="text-left"><a href="void:javascript(0)" style="text-decoration:none">{{ $article->title }}</a></td>
                            <td><a href="{{ route('catalogue.search.one', $article->artileCategory->name) }}" class="text-danger text-decoration-none">{{ $article->artileCategory->name }}</a></td>
                            <!--<td><button class="btn btn-sm background-orange text-white">Gửi mail</button></td>-->
                            <td>
                                <input type="text" class="nb-sort-order sort-order-{{ $key }}" value="{{ $article->sort_order }}" id="{{ $article->id }}" name="sort_order">
                            </td>
                            <td>{{ date('H:i d-m-Y', strtotime($article->created_at)) }}</td>
                            <td>
                                @if ($article->avatar_image)
                                    <img src="{{ asset($article->avatar_image) }}" alt="image" width="30px" height="30px" class="img-fluid">
                                @else
                                    <i class="fa fa-file-image-o fa-lg"></i>
                                @endif

                            </td>
                            <td>
                                @if ($article->publish)
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $article->id }}" title="Status" data-name="publish">
                                        <i class="fa fa-check fa-lg text-success"></i>
                                    </span>
                                @else
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $article->id }}" title="Status"  data-name="publish">
                                        <i class="fa fa-remove fa-lg text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($article->highlight)
                                    <span class="nb-check-highlight-{{ $key }} nb-check nb-highlight-status" id="{{ $article->id }}" title="Status" data-name="highlight"  data-change="0">
                                        <i class="fa fa-check fa-lg text-success"></i>
                                    </span>
                                @else
                                    <span class="nb-check-highlight-{{ $key }} nb-check nb-highlight-status" id="{{ $article->id }}" title="Status" data-name="highlight"  data-change="1">
                                        <i class="fa fa-remove fa-lg text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($article->lastest)
                                    <span class="nb-check-lastest-{{ $key }} nb-check nb-lastest-status" id="{{ $article->id }}" title="Status" data-name="lastest"  data-change="0">
                                        <i class="fa fa-check fa-lg text-success"></i>
                                    </span>
                                @else
                                    <span class="nb-check-lastest-{{ $key }} nb-check nb-lastest-status" id="{{ $article->id }}" title="Status" data-name="lastest"  data-change="1">
                                        <i class="fa fa-remove fa-lg text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('menus.create') }}" title="Make menu" class="getlink" target="" data-url="{{ route('news', ['slug' => $article->slug, 'id' => $article->id]) }}" data-url-lang="
                                    @if ($article->language)
                                        @foreach ($article->language as $lang)
                                            @if ($lang->name_code == Session::get('lang'))
                                                {{-- {{ $lang->pivot->slug }} --}}
                                                {{ route('news', ['slug' => $lang->pivot->slug, 'id' => $article->id]) }}
                                            @endif
                                        @endforeach
                                    @endif
                                    ">
                                    <i class="fa fa-bars nb-cta-action" aria-hidden="true"></i>
                                </a>
                                <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $article->id }}" data-url="{{ route('post.remove') }}">
                                    <i class="fa fa-trash text-danger nb-cta-action "></i>
                                </a>
                                <a href="{{ route('post.edit', $article->id) }}" title="Edit"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <div class="mb-2 form-inline" style="display:inline-block">
                    <form action="{{ route('post.search') }}" method="GET">
                        {{-- @csrf --}}
                        <input type="text" name="search_name" placeholder="Nhập tên bài viết" class="form-control">
                        <select name="search_cate" id="" class="form-control ml-1">
                            <option value="">- Chọn danh mục -</option>
                            {{-- @foreach ($articleCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach --}}

                            @if ($articleCategories)
                                {{ showCategories($articleCategories) }}
                            @else
                                There are no subcategories
                            @endif
                        </select>
                        <button class="ml-1 btn btn-danger" type="submit">Tìm kiếm</button>
                    </form>

                </div>
                <div class="float-right">
                    <a href="void:javascript(0)" class="btn btn-danger nb-delete-all" data-ids="" data-url="{{ route('post.remove.all') }}"><i class="fa fa-trash fa-lg text-white"></i>&nbsp; Xóa hết</a>
                </div>

            </table>
            <div class="float-right">
                {{ $articles->appends(Request::except('page'))->links() }}
            </div>
        </div>
    </section>
    <!-- Modal -->
    @include('partials.admin.modal_delete')
    @include('partials.admin.modal_delete_all')
@endsection
@section('script')
    <script>
        $(function(){
            $('.getlink').click(function(){
                var base_url = window.location.origin

                var url = $(this).attr('data-url')
                var link = url.replace(base_url, '')
                link = link.replace('.html', '')

                var url_lang = $(this).attr('data-url-lang')
                var link_lang = url_lang.replace(base_url, '')
                link_lang = link_lang.replace('.html', '')

                if(window.name){
                    if(window.name == 'popupWindow'){
                        window.opener.$('.nb-getlink').attr('value',link)
                    }
                    else if(window.name == 'popupWindowLanguage'){
                        window.opener.$('.' + window.name).attr('value',link_lang)
                    }
                    else{
                        console.log(window.name)
                        window.opener.$('.' + window.name).attr('value',link)
                    }
                    window.close()
                }else {
                    $('.getlink').attr('target', '_blank')
                    localStorage.setItem( 'stringToPass', link )
                }

            })
        })
    </script>
@endsection
