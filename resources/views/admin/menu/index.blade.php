@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
    <section id="nb-partner">
        <div class="container-fluid mt-4">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr class="table-info text-center">
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Module</th>
                        <th scope="col">Module ID</th>
                        <th scope="col">Module Item</th>
                        <th scope="col">Vị trí menu</th>
                        <th scope="col">Vị trí</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Hiển thị</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $key => $menu)
                        <tr class="text-center nb-tr-{{ $menu->id }}" data-url="{{ route('menus.status') }}">
                            <td>{{ $menu->title }}</td>
                            <td>{{ $menu->url }}</td>
                            <td>{{ $menu->module }}</td>
                            <td>{{ $menu->module_id }}</td>
                            <td>{{ $menu->module_item }}</td>
                            <td><a href="{{ route('menus.search.location', $menu->location_id) }}" class="text-danger text-decoration-none">{{ $menu->location->title }}</a></td>
                            <td><input type="text" class="nb-sort-order sort-order-{{ $key }}" value="{{ $menu->sort_order }}" id="{{ $menu->id }}" name="sort_order"></td>
                            <td>{{ date('H:i d-m-Y', strtotime($menu->created_at)) }}</td>
                            <td>
                                @if ($menu->publish)
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $menu->id }}" title="Status" data-name="publish">
                                        <i class="fa fa-check fa-lg text-success"></i>
                                    </span>
                                @else
                                    <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $menu->id }}" title="Status"  data-name="publish">
                                        <i class="fa fa-remove fa-lg text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $menu->id }}" data-url="{{ route('menus.remove') }}">
                                    <i class="fa fa-trash text-danger nb-cta-action "></i>
                                </a>
                                <a href="{{ route('menus.edit', $menu->id) }}" title="Edit"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <div class="mb-2 form-inline" style="display:inline-block">
                    <form action="{{ route('menus.search.menu') }}" method="POST">
                        @csrf
                        <input type="text" name="search_name" placeholder="Nhập tên menu" class="form-control">
                        <button class="ml-1 btn btn-danger" type="submit">Tìm kiếm</button>
                    </form>

                </div>


            </table>
            <div class="float-right">
                {{ $menus->links() }}
            </div>
        </div>
    </section>
    <!-- Modal -->
    @include('partials.admin.modal_delete')
@endsection
