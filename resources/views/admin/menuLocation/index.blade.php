@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
    <section id="nb-partner">
        <div class="container-fluid mt-4">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr class="table-info text-center">
                        <th scope="col">Mã</th>
                        <th scope="col">Tên vị trí</th>
                        <th scope="col">Từ khóa</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Vị trí</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Hiển thị</th>
                        <th scope="col">Người tạo</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menuLocations as $key => $menuLocation)
                        <tr class="text-center nb-tr-{{ $menuLocation->id }}" data-url="{{ route('menu-location.status') }}">
                            <td>{{ $menuLocation->id }}</td>
                            <td>{{ $menuLocation->title }}</td>
                            <td>{{ $menuLocation->keyword }}</td>
                            <td><a href="{{ route('menu-location.search.menu', $menuLocation->id) }}" class="text-danger text-decoration-none">{{ $menuLocation->menu->count() }}</a></td>

                            <td><input type="text" class="nb-sort-order sort-order-{{ $key }}" value="{{ $menuLocation->sort_order }}" id="{{ $menuLocation->id }}" name="sort_order"></td>
                            <td>{{ date('H:i d-m-Y', strtotime($menuLocation->created_at)) }}</td>
                            <td>
                                @if ($menuLocation->publish)
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $menuLocation->id }}" title="Status" data-name="publish">
                                        <i class="fa fa-check fa-lg text-success"></i>
                                    </span>
                                @else
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $menuLocation->id }}" title="Status"  data-name="publish">
                                        <i class="fa fa-remove fa-lg text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>{{ $menuLocation->user_name}}</td>
                            <td>
                                @if (Auth::user()->permission_id == 0)

                                    <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $menuLocation->id }}" data-url="{{ route('menu-location.remove') }}">
                                        <i class="fa fa-trash text-danger nb-cta-action "></i>
                                    </a>
                                @endif
                                <a href="{{ route('menu-location.edit', $menuLocation->id) }}" title="Edit"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <div class="mb-2 form-inline" style="display:inline-block">
                    <form action="{{ route('menu-location.search.location') }}" method="POST">
                        @csrf
                        <input type="text" name="search_name" placeholder="Nhập tên vị trí" class="form-control">
                        <button class="ml-1 btn btn-danger" type="submit">Tìm kiếm</button>
                    </form>

                </div>


            </table>
            <div class="float-right">
                {{ $menuLocations->links() }}
            </div>
        </div>
    </section>
    <!-- Modal -->
    @include('partials.admin.modal_delete')
@endsection
