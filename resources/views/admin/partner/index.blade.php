@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
    <section id="nb-partner">
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
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Hình</th>
                        <th scope="col">Loại</th>
                        <th scope="col">Link quảng cáo</th>
                        <th scope="col">Vị trí</th>
                        <th scope="col">Hiển thị</th>
                        {{-- <th scope="col">Ngày tạo</th>
                        <th scope="col">Ngày cập nhật</th> --}}
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($partners as $key => $partner)
                        <tr class="text-center nb-tr-{{ $partner->id }}" data-url="{{ route('partners.status') }}">
                            <td>{{ $partner->id }}</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check-{{ $key }}" data-id="{{ $partner->id }}">
                                    <label class="custom-control-label" for="check-{{ $key }}"></label>
                                </div>
                            </td>
                            <td class="text-left"><a href="void:javascript(0)" class="text-decoration-none">{{ $partner->title }}</a></td>
                            <td>
                                @if ($partner->avatar_image)

                                <img src="{{ asset($partner->avatar_image) }}" alt="image" width="30px" height="30px" class="img-fluid">
                                @else
                                    <i class="fa fa-file-image-o fa-lg"></i>
                                @endif
                            </td>
                            <td>{{ $partner->type_id == 1 ? "Đối tác" : "Khách hàng"}}</td>
                            <td><a href="{{ $partner->link }}">{{ $partner->link }}</a></td>
                            <td>
                                <input type="text" class="nb-sort-order sort-order-{{ $key }}" value="{{ $partner->sort_order }}" id="{{ $partner->id }}" name="sort_order">
                            </td>
                            <td>
                                @if ($partner->publish)
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $partner->id }}" title="Status" data-name="publish">
                                        <i class="fa fa-check fa-lg text-success"></i>
                                    </span>
                                @else
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $partner->id }}" title="Status"  data-name="publish">
                                        <i class="fa fa-remove fa-lg text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            {{-- <td>{{ date('H:i d-m-Y', strtotime($partner->created_at)) }}</td>
                            <td>{{ date('H:i d-m-Y', strtotime($partner->updated_at)) }}</td> --}}
                            <td>
                                <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $partner->id }}" data-url="{{ route('partners.remove') }}">
                                    <i class="fa fa-trash text-danger nb-cta-action "></i>
                                </a>
                                <a href="{{ route('partners.edit', $partner->id) }}" title="Edit"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <div class="mb-2 form-inline" style="display:inline-block">
                    <form action="{{ route('partners.search') }}" method="POST">
                        @csrf
                        <input type="text" name="search_name" placeholder="Nhập tên bài viết" class="form-control">
                        <button class="ml-1 btn btn-danger" type="submit">Tìm kiếm</button>
                    </form>

                </div>
                <div class="float-right">
                    <a href="void:javascript(0)" class="btn btn-danger nb-delete-all" data-ids="" data-url="{{ route('partners.remove.all') }}"><i class="fa fa-trash fa-lg text-white"></i>&nbsp; Xóa hết</a>
                </div>

            </table>
            <div class="float-right">
                {{ $partners->links() }}
            </div>
        </div>
    </section>
    <!-- Modal -->
    @include('partials.admin.modal_delete')
    @include('partials.admin.modal_delete_all')
@endsection
