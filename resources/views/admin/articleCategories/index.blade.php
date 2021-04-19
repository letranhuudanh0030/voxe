@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
<section id="nb-article-category">
    <div class="container-fluid mt-4">
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="table-info text-center">
                    <th scope="col">@sortablelink('id', 'Mã')</th>
                    <th scope="col">@sortablelink('name', 'Tên danh mục')</th>
                    <th scope="col">@sortablelink('page_type', 'Loại trang')</th>
                    <th scope="col">Số bài viết</th>
                    <th scope="col">@sortablelink('sort_order', 'Vị trí')</th>
                    <th scope="col">@sortablelink('created_at', 'Ngày tạo')</th>
                    <th scope="col">Hiển thị</th>
                    <th scope="col">Nổi bật</th>
                    <th scope="col">Link</th>
                    <th scope="col">1 bài viết</th>
                    <th scope="col">Bỏ link</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articleCategories as $key => $articleCategorie)

                <tr class="text-center nb-tr-{{ $articleCategorie->id }}" data-url="{{ route('catalogue.status') }}">
                    <th scope="row">{{ $articleCategorie->id }}</th>
                    <td class="text-left"><a href="void:javascript(0)" style="text-decoration:none">{{ $articleCategorie->name }}</a></td>
                    <td>
                    @switch($articleCategorie->page_type)
                        @case(0)
                            <span class="nb-page-type bg-secondary">{{ config('variables.page_type')[0] }}</span>
                            @break
                        @case(1)
                            <span class="nb-page-type background-yellow">{{ config('variables.page_type')[1] }}</span>
                            @break
                        @case(2)
                            <span class="nb-page-type bg-primary">{{ config('variables.page_type')[2] }}</span>
                            @break
                        @case(3)
                            <span class="nb-page-type background-blue">{{ config('variables.page_type')[3] }}</span>
                            @break
                        @case(4)
                            <span class="nb-page-type bg-success">{{ config('variables.page_type')[4] }}</span>
                            @break
                        @case(5)
                            <span class="nb-page-type bg-info">{{ config('variables.page_type')[5] }}</span>
                            @break
                        @case(6)
                            <span class="nb-page-type bg-danger">{{ config('variables.page_type')[6] }}</span>
                            @break
                        @case(7)
                            <span class="nb-page-type bg-secondary">{{ config('variables.page_type')[7] }}</span>
                            @break
                        @case(8)
                            <span class="nb-page-type bg-secondary">{{ config('variables.page_type')[8] }}</span>
                            @break
                        @case(9)
                            <span class="nb-page-type bg-secondary">{{ config('variables.page_type')[9] }}</span>
                            @break
                        @case(10)
                            <span class="nb-page-type bg-secondary">{{ config('variables.page_type')[10] }}</span>
                            @break
                        @case(11)
                            <span class="nb-page-type bg-secondary">{{ config('variables.page_type')[11] }}</span>
                            @break
                        @case(12)
                            <span class="nb-page-type bg-secondary">{{ config('variables.page_type')[12] }}</span>
                            @break
                        @case(13)
                            <span class="nb-page-type bg-secondary">{{ config('variables.page_type')[13] }}</span>
                            @break
                        @default
                            @break
                    @endswitch
                       
                    </td>
                    <td><a href="{{ route('post.search.one', $articleCategorie->id) }}" class="text-danger text-decoration-none">{{ $articleCategorie->article->count() }}</a></td>
                    <td>
                        <input type="text" class="nb-sort-order sort-order-{{ $key }}" value="{{ $articleCategorie->sort_order }}" id="{{ $articleCategorie->id }}" name="sort_order">
                    </td>
                    <td>{{ date('H:i d-m-Y', strtotime($articleCategorie->created_at)) }}</td>
                    <td>
                        @if ($articleCategorie->publish)
                            <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $articleCategorie->id }}" title="Status" data-name="publish">
                                <i class="fa fa-check fa-lg text-success"></i>
                            </span>
                        @else
                            <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $articleCategorie->id }}" title="Status"  data-name="publish">
                                <i class="fa fa-remove fa-lg text-secondary"></i>
                            </span>
                        @endif
                    </td>
                    <td>
                        @if ($articleCategorie->highlight)
                            <span class="nb-check-highlight-{{ $key }} nb-check nb-highlight-status" id="{{ $articleCategorie->id }}" title="Status" data-name="highlight"  data-change="0">
                                <i class="fa fa-check fa-lg text-success"></i>
                            </span>
                        @else
                            <span class="nb-check-highlight-{{ $key }} nb-check nb-highlight-status" id="{{ $articleCategorie->id }}" title="Status" data-name="highlight"  data-change="1">
                                <i class="fa fa-remove fa-lg text-secondary"></i>
                            </span>
                        @endif
                    </td>
                    <td>
                        @if ($articleCategorie->link)
                            <span class="nb-check-link-{{ $key }} nb-check nb-link-status" id="{{ $articleCategorie->id }}" title="Status" data-name="link"  data-change="0">
                                <i class="fa fa-check fa-lg text-success"></i>
                            </span>
                        @else
                            <span class="nb-check-link-{{ $key }} nb-check nb-link-status" id="{{ $articleCategorie->id }}" title="Status" data-name="link"  data-change="1">
                                <i class="fa fa-remove fa-lg text-secondary"></i>
                            </span>
                        @endif
                    </td>
                    <td>
                        @if ($articleCategorie->one_article)
                            <span class="nb-check-onepage-{{ $key }} nb-check nb-onepage-status" id="{{ $articleCategorie->id }}" title="Status" data-name="onepage"  data-change="0">
                                <i class="fa fa-check fa-lg text-success"></i>
                            </span>
                        @else
                            <span class="nb-check-onepage-{{ $key }} nb-check nb-onepage-status" id="{{ $articleCategorie->id }}" title="Status" data-name="onepage"  data-change="1">
                                <i class="fa fa-remove fa-lg text-secondary"></i>
                            </span>
                        @endif
                    </td>
                    <td>
                        @if ($articleCategorie->un_link)
                            <span class="nb-check-unlink-{{ $key }} nb-check nb-onepage-status" id="{{ $articleCategorie->id }}" title="Status" data-name="unlink"  data-change="0">
                                <i class="fa fa-check fa-lg text-success"></i>
                            </span>
                        @else
                            <span class="nb-check-unlink-{{ $key }} nb-check nb-onepage-status" id="{{ $articleCategorie->id }}" title="Status" data-name="unlink"  data-change="1">
                                <i class="fa fa-remove fa-lg text-secondary"></i>
                            </span>
                        @endif
                    </td>
                    <td>
                        @if (Auth::user()->permission_id == 0)
                            <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $articleCategorie->id }}" data-url="{{ route('catalogue.remove') }}"><i class="fa fa-trash text-danger nb-cta-action"></i></a>
                        @endif
                        <a href="{{ route('catalogue.edit', $articleCategorie->id) }}" title="Edit"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <div class="mb-2 form-inline">
                <form action="{{ route('catalogue.search') }}" method="POST">
                    @csrf
                    {{-- <input type="text" name="search_name" placeholder="Nhập tên danh mục" class="form-control"> --}}
                    <select name="search_name" id="" class="form-control ml-1">
                        <option value="">- Chọn danh mục -</option>
                        @if ($categories)
                            {{ showCategories($categories) }}
                        @else
                            There are no subcategories
                        @endif
                    </select>
                    <select name="search_type" id=""  class="form-control ml-1">
                        <option value="">- Chọn loại trang -</option>
                        @foreach (config('variables.page_type') as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    <button class="ml-1 btn btn-danger">Tìm kiếm</button>
                </form>
            </div>
        </table>
        <div class="float-right">
            {{ $articleCategories->links() }}
        </div>
    </div>
    <!-- Modal -->
    @include('partials.admin.modal_delete')
</section>
@endsection
