@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
    <section id="nb-products">
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
                        <th scope="col">Hình</th>
                        <th scope="col">@sortablelink('title', 'Tên sản phẩm')</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Loại sản phẩm</th>
                        <th scope="col">@sortablelink('sort_order', 'Vị trí')</th>
                        <th scope="col">@sortablelink('created_at', 'Ngày tạo')</th>
                        <th scope="col">Hiển thị</th>
                        <th scope="col">Tiêu biểu</th>
                        <th scope="col">Mới nhất</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr class="text-center nb-tr-{{ $product->id }}" data-url="{{ route('products.status') }}">
                            <td>{{ $product->id }}</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check-{{ $key }}" data-id="{{ $product->id }}">
                                    <label class="custom-control-label" for="check-{{ $key }}"></label>
                                </div>
                            </td>
                            <td>
                                @if ($product->avatar_image)

                                <img src="{{ asset($product->avatar_image) }}" alt="image" width="30px" height="30px" class="img-fluid">
                                @else
                                    <i class="fa fa-file-image-o fa-lg"></i>
                                @endif
                            </td>
                            <td class="text-left"><a href="void:javascript(0)" class="text-decoration-none">{{ $product->title }}</a></td>
                            <td>
                                <a href="{{ route('product-type.search.one', $product->productCategory->name) }}" class="text-decoration-none">{{ $product->productCategory->name }}</a>
                            </td>
                            <td class="nb-mark-{{ $key }}">
                                @if ($product->highlight == 1)
                                    <span class="nb-page-type background-orange nb-mark-highlight-{{ $key }} ">Tiêu biểu</span>
                                @else
                                    <span class="nb-page-type bg-secondary nb-mark-nhighlight-{{ $key }} ">Mặc định</span>
                                @endif

                                @if ($product->lastest == 1)
                                    <span class="nb-page-type bg-success nb-mark-lastest-{{ $key }} ">Mới nhất</span>
                                @endif
                            </td>
                            <td>
                                <input type="text" class="nb-sort-order sort-order-{{ $key }}" value="{{ $product->sort_order }}" id="{{ $product->id }}" name="sort_order">
                            </td>
                            <td>{{ date('H:i d-m-Y', strtotime($product->created_at)) }}</td>
                            <td>
                                @if ($product->publish)
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $product->id }}" title="Status" data-name="publish">
                                        <i class="fa fa-check fa-lg text-success"></i>
                                    </span>
                                @else
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $product->id }}" title="Status"  data-name="publish">
                                        <i class="fa fa-remove fa-lg text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($product->highlight)
                                    <span class="nb-check-highlight-{{ $key }} nb-check nb-highlight-status" id="{{ $product->id }}" title="Status" data-name="highlight"  data-change="0">
                                        <i class="fa fa-check fa-lg text-success"></i>
                                    </span>
                                @else
                                    <span class="nb-check-highlight-{{ $key }} nb-check nb-highlight-status" id="{{ $product->id }}" title="Status" data-name="highlight"  data-change="1">
                                        <i class="fa fa-remove fa-lg text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($product->lastest)
                                    <span class="nb-check-lastest-{{ $key }} nb-check nb-lastest-status" id="{{ $product->id }}" title="Status" data-name="lastest"  data-change="0">
                                        <i class="fa fa-check fa-lg text-success"></i>
                                    </span>
                                @else
                                    <span class="nb-check-lastest-{{ $key }} nb-check nb-lastest-status" id="{{ $product->id }}" title="Status" data-name="lastest"  data-change="1">
                                        <i class="fa fa-remove fa-lg text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $product->id }}" data-url="{{ route('products.remove') }}">
                                    <i class="fa fa-trash text-danger nb-cta-action "></i>
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" title="Edit"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
                <div class="mb-2 form-inline" style="display:inline-block">
                    <form action="{{ route('products.search') }}" method="GET">
                        {{-- @csrf --}}
                        <input type="text" name="search_name" placeholder="Nhập tên bài viết" class="form-control">
                        <select name="search_cate" id="" class="form-control ml-1">
                            <option value="">- Chọn danh mục -</option>
                            @if ($productCategories)
                            {{ showCategories($productCategories) }}
                            @else
                            There are no subcategories
                            @endif
                        </select>
                        <div class="mb-2 form-inline" style="display:inline-block">
                            Hiển thị số sản phẩm:
                            <select name="showItem" id="" class="form-control ml-1">
                                @foreach (config('variables.show_paginate') as $num)
                                    @if ($num == 0)
                                        <option value="{{ $num }}" {{ $num == request()->showItem ? "selected" :""}}>Tất cả</option>
                                    @else
                                        <option value="{{ $num }}" {{ $num == request()->showItem ? "selected" :""}} {{ !request()->showItem && $num == 10 ? "selected" :""}} >{{ $num }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button class="ml-1 btn btn-danger" type="submit">Lọc</button>
                    </form>

                </div>
                <div class="float-right">
                    
                    <a href="void:javascript(0)" class="btn btn-danger nb-delete-all" data-ids="" data-url="{{ route('products.remove.all') }}"><i class="fa fa-trash fa-lg text-white"></i>&nbsp; Xóa hết</a>
                </div>

            </table>
            <div class="float-right">
                @if (request()->showItem != 0)
                    {{ $products->appends(Request::except('page'))->links()}}
                @else
                    {{ $products->links()}}
                @endif
            </div>
        </div>
    </section>
    <!-- Modal -->
    @include('partials.admin.modal_delete')
    @include('partials.admin.modal_delete_all')
@endsection

