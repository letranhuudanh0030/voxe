@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
    <section id="nb-video">
        <div class="container-fluid mt-4">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr class="table-info text-center">
                        <th scope="col">Mã</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">video</th>
                        <th scope="col">Hiển thị</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Ngày cập nhật</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $key => $video)
                        <tr class="text-center nb-tr-{{ $video->id }}" data-url="{{ route('videos.status') }}">
                            <td>{{ $video->id }}</td>

                            <td class="text-left"><a href="void:javascript(0)" class="text-decoration-none">{{ $video->title }}</a></td>
                            <td><a href="https://www.youtube.com/watch?v={{ $video->link }}" target="_blank">{{ $video->link }}</a></td>
                            <td>
                                @if ($video->publish)
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $video->id }}" title="Status" data-name="publish">
                                        <i class="fa fa-check fa-lg text-success"></i>
                                    </span>
                                @else
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $video->id }}" title="Status"  data-name="publish">
                                        <i class="fa fa-remove fa-lg text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>{{ date('H:i d-m-Y', strtotime($video->created_at)) }}</td>
                            <td>{{ date('H:i d-m-Y', strtotime($video->updated_at)) }}</td>
                            <td>
                                <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $video->id }}" data-url="{{ route('videos.remove') }}">
                                    <i class="fa fa-trash text-danger nb-cta-action "></i>
                                </a>
                                <a href="{{ route('videos.edit', $video->id) }}" title="Edit"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">
                {{ $videos->links() }}
            </div>
        </div>
    </section>
    <!-- Modal -->
    @include('partials.admin.modal_delete')
@endsection
