@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
<section id="nb-article-category">
    <div class="container-fluid mt-4">
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="table-info text-center">
                    <th scope="col">@sortablelink('id', 'Mã')</th>
                    <th scope="col">@sortablelink('name', 'Hãng sản xuất')</th>
                    <th scope="col">Số sản phẩm</th>
                    <th scope="col">@sortablelink('sort_order', 'Vị trí')</th>
                    <th scope="col">@sortablelink('created_at', 'Ngày tạo')</th>
                    <th scope="col">Hiển thị</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $key => $brand)
                    <tr class="text-center nb-tr-{{ $brand->id }}" data-url="{{ route('brands.status') }}">
                        <td>{{ $brand->id }}</td>
                        <td class="text-left"><a href="void:javascript(0)" class="text-decoration-none">{{ $brand->name }}</a></td>
                        <td><a href="void:javascript(0)" class="text-danger text-decoration-none">{{ $brand->product->count() }}</a></td>
                        <td><input type="text" class="nb-sort-order sort-order-{{ $key }}" value="{{ $brand->sort_order }}" id="{{ $brand->id }}" name="sort_order"></td>
                        <td>{{ date('H:i d-m-Y',strtotime($brand->created_at)) }}</td>
                        <td>
                            @if ($brand->publish)
                            <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $brand->id }}" title="Status" data-name="publish">
                                <i class="fa fa-check fa-lg text-success"></i>
                            </span>
                            @else
                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $brand->id }}" title="Status"  data-name="publish">
                                    <i class="fa fa-remove fa-lg text-secondary"></i>
                                </span>
                            @endif

                        </td>
                        <td>
                            <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $brand->id }}" data-url="{{ route('brands.remove') }}"><i class="fa fa-trash text-danger nb-cta-action"></i></a>
                            <a href="{{ route('brands.edit', $brand->id) }}" title="Edit"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <div class="mb-2 form-inline">
                <form action="{{ route('brands.search', '') }}" method="POST">
                    @csrf
                    <input type="text" name="search_name" placeholder="Nhập tên danh mục" class="form-control">
                    <button class="ml-1 btn btn-danger">Tìm kiếm</button>
                </form>
            </div>
        </table>
        <div class="float-right">
            {{ $brands->links() }}
        </div>
    </div>
    <!-- Modal -->
    @include('partials.admin.modal_delete')
</section>
@endsection
