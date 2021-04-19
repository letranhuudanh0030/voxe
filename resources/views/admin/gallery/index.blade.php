@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
    <section id="nb-gallery">
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
                        <th scope="col">Link quảng cáo</th>
                        <th scope="col">Thứ tự</th>
                        <th scope="col">Hiển thị</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Ngày cập nhật</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galleries as $key => $gallery)
                        <tr class="text-center nb-tr-{{ $gallery->id }}" data-url="{{ route('galleries.status') }}">
                            <td>{{ $gallery->id }}</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check-{{ $key }}" data-id="{{ $gallery->id }}">
                                    <label class="custom-control-label" for="check-{{ $key }}"></label>
                                </div>
                            </td>
                            <td class="text-left"><a href="void:javascript(0)" class="text-decoration-none">{{ $gallery->title }}</a></td>
                            <td>
                                @if ($gallery->avatar_image)

                                <img src="{{ asset($gallery->avatar_image) }}" alt="image" width="30px" height="30px" class="img-fluid">
                                @else
                                    <i class="fa fa-file-image-o fa-lg"></i>
                                @endif
                            </td>
                            <td><a href="{{ $gallery->link }}">{{ $gallery->link }}</a></td>
                            <td>
                                <input type="text" class="nb-sort-order sort-order-{{ $key }}" value="{{ $gallery->sort_order }}" id="{{ $gallery->id }}" name="sort_order">
                            </td>
                            <td>
                                @if ($gallery->publish)
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $gallery->id }}" title="Status" data-name="publish">
                                        <i class="fa fa-check fa-lg text-success"></i>
                                    </span>
                                @else
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $gallery->id }}" title="Status"  data-name="publish">
                                        <i class="fa fa-remove fa-lg text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>{{ date('H:i d-m-Y', strtotime($gallery->created_at)) }}</td>
                            <td>{{ date('H:i d-m-Y', strtotime($gallery->updated_at)) }}</td>
                            <td>
                                <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $gallery->id }}" data-url="{{ route('galleries.remove') }}">
                                    <i class="fa fa-trash text-danger nb-cta-action "></i>
                                </a>
                                <a href="{{ route('galleries.edit', $gallery->id) }}" title="Edit"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <div class="float-right mb-2">
                    <a href="void:javascript(0)" class="btn btn-danger nb-delete-all btn-lg" data-ids="" data-url="{{ route('galleries.remove.all') }}"><i class="fa fa-trash fa-lg text-white"></i>&nbsp; Xóa hết</a>
                </div>
            </table>
            <div class="float-right">
                {{ $galleries->links() }}
            </div>
        </div>
    </section>
    <!-- Modal -->
    @include('partials.admin.modal_delete')
    @include('partials.admin.modal_delete_all')
@endsection

