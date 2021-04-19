@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
<section id="real-estate">
    <div class="container-fluid mt-4">
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="table-info text-center">
                    <th scope="col">Mã</th>
                    <th scope="col">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="check-all">
                            <label class="custom-control-label" for="check-all"></label>
                        </div>
                    </th>
                    <th scope="col">Hình</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Loại</th>
                    <th scope="col">Vị trí</th>
                    <th scope="col">Hiển thị</th>
                    <th scope="col">Nổi bật</th>
                    <th scope="col">Mới nhất</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estates as $key => $estate)
                    <tr class="text-center nb-tr-{{ $estate->id }}"
                        data-url="{{ route('estate.status') }}">
                        <td>{{ $estate->id }}</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check-{{ $key }}"
                                    data-id="{{ $estate->id }}">
                                <label class="custom-control-label" for="check-{{ $key }}"></label>
                            </div>
                        </td>
                        <td>
                            @if($estate->avatar_image)
                                <a href="{{ asset($estate->avatar_image) }}" data-fancybox="images">
                                    <img src="{{ asset($estate->avatar_image) }}" alt="image" width="30px"
                                        height="30px" class="img-fluid">
                                </a>
                            @else
                                <i class="fa fa-file-image-o fa-lg"></i>
                            @endif
                        </td>
                        <td class="text-left">{{ $estate->title }}</td>
                        {{-- <td class="text-left">{{ $estate->ward['name'] }},
                        {{ $estate->district['name'] }},
                        {{ $estate->city['name'] }}</td>
                        <td class="text-left">
                            {{ $estate->price == 0 ? "Thương lượng" :  number_format($estate->price, 0) }}
                            {{ $estate->currency == 1 ? "VND" : "VND/m2" }}
                        </td> --}}
                        <td class="text-left">{{ $estate->productCategory->name }} <span
                                class="text-danger">({{ $category->where('id', $estate->productCategory->parent_id)->first()->name }})</span>
                        </td>
                        <td>
                            <input type="text" class="nb-sort-order sort-order-{{ $key }}"
                                value="{{ $estate->sort_order }}" id="{{ $estate->id }}" name="sort_order">
                        </td>
                        <td>
                            @if($estate->publish)
                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0"
                                    id="{{ $estate->id }}" title="Status" data-name="publish">
                                    <i class="fa fa-check fa-lg text-success"></i>
                                </span>
                            @else
                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1"
                                    id="{{ $estate->id }}" title="Status" data-name="publish">
                                    <i class="fa fa-remove fa-lg text-secondary"></i>
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($estate->highlight)
                                <span class="nb-check-highlight-{{ $key }} nb-check nb-highlight-status"
                                    id="{{ $estate->id }}" title="Status" data-name="highlight" data-change="0">
                                    <i class="fa fa-check fa-lg text-success"></i>
                                </span>
                            @else
                                <span class="nb-check-highlight-{{ $key }} nb-check nb-highlight-status"
                                    id="{{ $estate->id }}" title="Status" data-name="highlight" data-change="1">
                                    <i class="fa fa-remove fa-lg text-secondary"></i>
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($estate->lastest)
                                <span class="nb-check-lastest-{{ $key }} nb-check nb-lastest-status"
                                    id="{{ $estate->id }}" title="Status" data-name="lastest" data-change="0">
                                    <i class="fa fa-check fa-lg text-success"></i>
                                </span>
                            @else
                                <span class="nb-check-lastest-{{ $key }} nb-check nb-lastest-status"
                                    id="{{ $estate->id }}" title="Status" data-name="lastest" data-change="1">
                                    <i class="fa fa-remove fa-lg text-secondary"></i>
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete"
                                data-id="{{ $estate->id }}" data-url="{{ route('estate.remove') }}">
                                <i class="fa fa-trash text-danger nb-cta-action "></i>
                            </a>
                            <a href="{{ route('estate.edit', $estate->id) }}" title="Edit"><i
                                    class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
            {{-- <div class="mb-2 form-inline d-inline-block">
            </div> --}}
            <div class="row mb-2">
                <div class="col-6">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        Lọc dữ liệu
                    </button>
                </div>
                <div class="col-6 text-right">
                    <a href="void:javascript(0)" class="btn btn-danger nb-delete-all" data-ids=""
                        data-url="{{ route('estate.remove.all') }}"><i
                            class="fa fa-trash fa-lg text-white"></i>&nbsp; Xóa hết</a>
                </div>
                <div class="col-12 mt-2">
                    <div class="collapse" id="collapseExample">
                        @include('admin.realestate.filter')
                    </div>
                </div>
            </div>
            {{-- <div class="float-right mb-2">
            </div> --}}

        </table>
        <div class="float-right">
            {{ $estates->appends(Request::except('page'))->links() }}
        </div>
    </div>
</section>
<!-- Modal -->
@include('partials.admin.modal_delete')
@include('partials.admin.modal_delete_all')
@endsection

@section('css-admin')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endsection