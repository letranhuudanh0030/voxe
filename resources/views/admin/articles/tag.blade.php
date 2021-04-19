@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
    <section id="nb-config-tag">
        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-info-circle fa-lg mr-2"></i>Thông tin chung
                </div>
                <div class="card-body">
                   <form action="{{ route('tag.create') }}" method="POST">
                       @csrf
                       <div class="form-row">

                           <div class="col">
                               <label for="">Tên tag <span class="text-danger">(*)</span>: </label>
                               <input type="text" name="name" id="" class="form-control">
                           </div>
                           <div class="col">
                                <label for="">Link bài viết: </label><br>
                                <input type="text" name="link" id="" class="form-control d-inline-block nb-getlink" style="width:75%">
                                <button class="btn btn-primary btn-get-link" style="width: 20%">Lấy link</button>
                            </div>
                            {{-- <div class="col">
                                <label for="">Icon mạng xã hội <span class="text-danger">(*)</span>: (<a href="https://fontawesome.com/v4.7.0/icons/" target="_blank">truy cập để lấy icon</a>)</label>
                                <input type="text" name="icon" id="" class="form-control" placeholder="ví dụ: fa fa-facebook">
                            </div> --}}
                            <div class="col-12 mt-4 text-right">
                                <button class="btn btn-lg btn-primary">Thêm tag</button>
                                <button class="btn btn-lg btn-primary">Làm lại</button>
                            </div>
                       </div>
                   </form>
                </div>
            </div>
            <div class="card">
                    <div class="card-header">
                        <i class="fa fa-list fa-lg mr-2"></i>Danh sách tag
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tag</th>
                                    <th scope="col">Link</th>
                                    {{-- <th scope="col">Icon</th> --}}
                                    {{-- <th scope="col">Vị trí</th> --}}
                                    <th scope="col">Hiển thị</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $key => $tag)
                                    <tr class="text-center nb-row nb-tr-{{ $tag->id }}" data-url="{{ route('tag.status') }}">
                                        <td>{{ $tag->id }}</td>
                                        <td class="nb-edit-name-{{ $key }} text-left" >{{ $tag->name }}</td>
                                        <td class="nb-edit-link-{{ $key }} text-left" >{{ $tag->url }}</td>
                                        {{-- <td class="nb-edit-icon-{{ $key }} text-left" >{{ $tag->icon }}</td> --}}
                                        {{-- <td><input type="text" class="nb-sort-order sort-order-{{ $key }}" value="{{ $tag->sort_order }}" id="{{ $tag->id }}" name="sort_order"></td> --}}
                                        <td>
                                            @if ($tag->publish)
                                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $tag->id }}" title="Status" data-name="publish">
                                                    <i class="fa fa-check fa-lg text-success"></i>
                                                </span>
                                            @else
                                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $tag->id }}" title="Status"  data-name="publish">
                                                    <i class="fa fa-remove fa-lg text-secondary"></i>
                                                </span>
                                            @endif</td>
                                        <td>
                                            <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $tag->id }}" data-url="{{ route('tag.remove') }}">
                                                <i class="fa fa-trash text-danger nb-cta-action "></i>
                                            </a>
                                            <a href="void:javascript(0)" title="Edit" class="nb-edit-{{ $key }}" data-id="{{ $tag->id }}" data-url="{{ route('tag.update') }}"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>

                                            <a href="void:javascript(0)" title="Save" class="nb-save-{{ $key }}" style="display:none"><i class="fa fa-floppy-o nb-cta-action text-success" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
    @include('partials.admin.modal_delete')
@endsection

@section('script')
    <script>
        $(function(){
            for (let index = 0; index < $('.nb-row').length; index++) {

                $('.nb-edit-'+index).click(function(){
                    var vname = $('.nb-edit-name-' + index).text()
                    var vlink = $('.nb-edit-link-' + index).text()
                    // var vicon = $('.nb-edit-icon-' + index).text()

                    var id = $(this).attr('data-id')
                    var url = $(this).attr('data-url')
                    $('.nb-edit-name-' + index).html('<input type="text" class="form-control nb-input-name-'+id+'" placeholder="Nhập tên tag" value="'+vname+'"/>')
                    $('.nb-edit-link-' + index).html('<input type="text" class="form-control nb-input-link-'+id+' d-inline-block mr-2 " placeholder="Nhập link bài viết" value="'+vlink+'" style="width: 75%"/><button class="btn btn-primary btn-get-link-'+id+'">Link</button>')
                    // $('.nb-edit-icon-' + index).html('<input type="text" class="form-control nb-input-icon-'+id+'" placeholder="Nhập icon mạng xã hội" value="'+vicon+'"/>')
                    $('.nb-edit-' + index).css('display', 'none')
                    $('.nb-save-' + index).css('display', 'inline-block')
                    $('.nb-delete-' + index).css('display', 'none')

                    $('.nb-save-'+index).click(function(){

                        var name = $('.nb-input-name-'+id).val();
                        var link = $('.nb-input-link-'+id).val();
                        // var icon = $('.nb-input-icon-'+id).val();
                        axios.post(url, {
                            name: name,
                            link: link,
                            // icon: icon,
                            id: id,
                        })
                        .then(function(response){
                            $('.nb-edit-name-' + index).text(response.data.name)
                            $('.nb-edit-link-' + index).text(response.data.url)
                            // $('.nb-edit-icon-' + index).text(response.data.icon)
                            $('.nb-edit-' + index).css('display', 'inline-block')
                            $('.nb-save-' + index).css('display', 'none')
                            $('.nb-delete-' + index).css('display', 'inline-block')
                            toastr.success('Cập nhật thành công.');
                        })
                        .catch(function(error){
                            console.log(error)
                        })

                    })

                    $('.btn-get-link-'+id+'').click(function (event) {
                        event.preventDefault();
                        var w = window.open("{{ route('post.index') }}", "nb-input-link-"+id+"", "width=1150, height=600, scrollbars=yes");
                    });
                })
            }

            $('.btn-get-link').click(function (event) {
                event.preventDefault();
                var w = window.open("{{ route('post.index') }}", "popupWindow", "width=1150, height=600, scrollbars=yes");
            });
        })
    </script>
@endsection

