@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
    <section id="nb-slide">
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
                    @foreach ($slides as $key => $slide)
                        <tr class="text-center nb-tr-{{ $slide->id }}" data-url="{{ route('slides.status') }}">
                            <td>{{ $slide->id }}</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="check-{{ $key }}" data-id="{{ $slide->id }}">
                                    <label class="custom-control-label" for="check-{{ $key }}"></label>
                                </div>
                            </td>
                            <td class="text-left"><a href="void:javascript(0)" class="text-decoration-none">{{ $slide->title }}</a></td>
                            <td>
                                @if ($slide->avatar_image)

                                <img src="{{ asset($slide->avatar_image) }}" alt="image" width="30px" height="30px" class="img-fluid">
                                @else
                                    <i class="fa fa-file-image-o fa-lg"></i>
                                @endif
                            </td>
                            <td><a href="{{ $slide->link }}">{{ $slide->link }}</a></td>
                            <td>
                                <input type="text" class="nb-sort-order sort-order-{{ $key }}" value="{{ $slide->sort_order }}" id="{{ $slide->id }}" name="sort_order">
                            </td>
                            <td>
                                @if ($slide->publish)
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $slide->id }}" title="Status" data-name="publish">
                                        <i class="fa fa-check fa-lg text-success"></i>
                                    </span>
                                @else
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $slide->id }}" title="Status"  data-name="publish">
                                        <i class="fa fa-remove fa-lg text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>{{ date('H:i d-m-Y', strtotime($slide->created_at)) }}</td>
                            <td>{{ date('H:i d-m-Y', strtotime($slide->updated_at)) }}</td>
                            <td>
                                <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $slide->id }}" data-url="{{ route('slides.remove') }}">
                                    <i class="fa fa-trash text-danger nb-cta-action "></i>
                                </a>
                                <a href="{{ route('slides.edit', $slide->id) }}" title="Edit"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <div class="float-right mb-2">
                    <a href="void:javascript(0)" class="btn btn-danger nb-delete-all btn-lg" data-ids="" data-url="{{ route('slides.remove.all') }}"><i class="fa fa-trash fa-lg text-white"></i>&nbsp; Xóa hết</a>
                </div>
            </table>
            <div class="float-right">
                {{ $slides->links() }}
            </div>
        </div>
    </section>
    <!-- Modal -->
    @include('partials.admin.modal_delete')
    @include('partials.admin.modal_delete_all')
@endsection
