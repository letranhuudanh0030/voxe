@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
<section id="nb-article-category">
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
                    <th scope="col">@sortablelink('name', 'Tên danh mục')</th>
                    <th scope="col">Danh mục cha</th>
                    <th scope="col">Số sản phẩm</th>
                    <th scope="col">@sortablelink('sort_order', 'Vị trí')</th>
                    <th scope="col">@sortablelink('created_at', 'Ngày tạo')</th>
                    <th scope="col">Hiển thị</th>
                    <th scope="col">Tiêu biểu</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($productCategories as $key => $productCategory)
                    <tr class="text-center nb-tr-{{ $productCategory->id }}" data-url="{{ route('product-type.status') }}">
                        <td>{{ $productCategory->id }}</td>
                        <td class="text-left"><a href="void:javascript(0)" class="text-decoration-none">{{ $productCategory->name }}</a></td>
                        <td>Cấp {{ showLevel($categories, $productCategory) }}</td>
                        <td><a href="{{ route('products.cate', $productCategory->id) }}" class="text-danger text-decoration-none">{{ $productCategory->products->count() }}</a></td>
                        <td><input type="text" class="nb-sort-order sort-order-{{ $key }}" value="{{ $productCategory->sort_order }}" id="{{ $productCategory->id }}" name="sort_order"></td>
                        <td>{{ date('H:i d-m-Y',strtotime($productCategory->created_at)) }}</td>
                        <td>
                            @if ($productCategory->publish)
                            <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $productCategory->id }}" title="Status" data-name="publish">
                                <i class="fa fa-check fa-lg text-success"></i>
                            </span>
                            @else
                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $productCategory->id }}" title="Status"  data-name="publish">
                                    <i class="fa fa-remove fa-lg text-secondary"></i>
                                </span>
                            @endif

                        </td>
                        <td>
                            @if ($productCategory->highlight)
                                <span class="nb-check-highlight-{{ $key }} nb-check nb-highlight-status" id="{{ $productCategory->id }}" title="Status" data-name="highlight"  data-change="0">
                                    <i class="fa fa-check fa-lg text-success"></i>
                                </span>
                            @else
                                <span class="nb-check-highlight-{{ $key }} nb-check nb-highlight-status" id="{{ $productCategory->id }}" title="Status" data-name="highlight"  data-change="1">
                                    <i class="fa fa-remove fa-lg text-secondary"></i>
                                </span>
                            @endif
                        </td>
                        <td>
                            @if (Auth::user()->permission_id == 0)

                                <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $productCategory->id }}" data-url="{{ route('product-type.remove') }}"><i class="fa fa-trash text-danger nb-cta-action"></i></a>
                            @endif
                            <a href="{{ route('product-type.edit', $productCategory->id) }}" title="Edit"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                        </td>
                    </tr>
                @endforeach --}}
                {{ ShowTable($productCategories) }}
            </tbody>
            <div class="mb-2 form-inline">
                <form action="{{ route('product-type.search', '') }}" method="GET">
                    @csrf
                    <input type="text" name="search_name" placeholder="Nhập tên danh mục" class="form-control">
                    <button class="ml-1 btn btn-danger">Tìm kiếm</button>
                </form>
            </div>
            <div class="float-right">
                <a href="void:javascript(0)" class="btn btn-danger nb-delete-all mb-2" data-ids="" data-url="{{ route('product-type.remove.all') }}"><i class="fa fa-trash fa-lg text-white"></i>&nbsp; Xóa hết</a>
            </div>
        </table>
        <div class="float-right">
            {{-- {{ $productCategories->links() }} --}}
        </div>
    </div>
    <!-- Modal -->
    @include('partials.admin.modal_delete')
    @include('partials.admin.modal_delete_all')
</section>

@endsection



