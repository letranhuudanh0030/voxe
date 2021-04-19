
@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
    <section id="nb-user">
        <div class="container-fluid mt-4">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr class="table-info text-center">
                        <th scope="col">Mã</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Điện thoại</th>
                        @if (Auth::user()->permission_id == 0)
                            <th scope="col">Quyền</th>
                        @endif
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @if (Auth::user()->permission_id == 1)

                        @foreach ($users->where('permission_id', 1) as $key => $user)
                            <tr class="text-center nb-tr-{{ $user->id }}" data-url="{{ route('user.status') }}">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td><a href="void:javascript(0)" class="text-decoration-none">{{ $user->email }}</a></td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    @if ($user->status)
                                        <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $user->id }}" title="Status" data-name="publish">
                                            <i class="fa fa-check fa-lg text-success"></i>
                                        </span>
                                    @else
                                        <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $user->id }}" title="Status"  data-name="publish">
                                            <i class="fa fa-remove fa-lg text-secondary"></i>
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if (Auth::user()->permission_id == 0)
                                        <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $user->id }}" data-url="{{ route('user.remove') }}">
                                            <i class="fa fa-trash text-danger nb-cta-action "></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('user.edit', $user->id) }}" title="Edit"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($users as $key => $user)
                            <tr class="text-center nb-tr-{{ $user->id }}" data-url="{{ route('user.status') }}">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td><a href="void:javascript(0)" class="text-decoration-none">{{ $user->email }}</a></td>
                                <td>{{ $user->phone }}</td>
                                    <td>
                                        @if ($user->permission_id == 0)
                                            Quản trị tổng thể
                                        @else
                                            Quản trị dữ liệu
                                        @endif
                                    </td>
                                <td>
                                    @if ($user->status)
                                        <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $user->id }}" title="Status" data-name="publish">
                                            <i class="fa fa-check fa-lg text-success"></i>
                                        </span>
                                    @else
                                        <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $user->id }}" title="Status"  data-name="publish">
                                            <i class="fa fa-remove fa-lg text-secondary"></i>
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $user->id }}" data-url="{{ route('user.remove') }}">
                                        <i class="fa fa-trash text-danger nb-cta-action "></i>
                                    </a>
                                    <a href="{{ route('user.edit', $user->id) }}" title="Edit"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-right">
                {{ $users->links() }}
            </div>
        </div>
    </section>
    <!-- Modal -->
    @include('partials.admin.modal_delete')
@endsection
