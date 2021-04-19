@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
    <section id="nb-config-social">
        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-info-circle fa-lg mr-2"></i>Thông tin chung
                </div>
                <div class="card-body">
                   <form action="{{ route('config.language.create') }}" method="POST">
                       @csrf
                       <div class="form-row">

                           <div class="col">
                               <label for="">Tên ngôn ngữ <span class="text-danger">(*)</span>: </label>
                               <input type="text" name="name" id="" class="form-control" placeholder="ví dụ: Việt Nam">
                           </div>
                           <div class="col">
                                <label for="">Mã ngôn ngữ <span class="text-danger">(*)</span>: </label>
                                <input type="text" name="code" id="" class="form-control" placeholder="ví dụ: vi">
                                <span class="text-small text-gray help-block-none">Lấy mã ngôn ngữ đúng chuẩn. <a href="http://www.lingoes.net/en/translator/langcode.htm" target="_blank">(Click vào đây)</a></span>
                            </div>
                            <div class="col">
                                <label for="">Hình ảnh <span class="text-danger">(*)</span>: </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="avatar_image" name="avatar_image" readonly value="{{ old('avatar_image') }}">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary browser2" data-toggle="modal" data-target="#modal-file" type="button" data-name-type='avatar_image'>Browser</button>
                                    </div>
                                </div>
                                <span class="text-small text-gray help-block-none">Chọn hình đại diện của ngôn ngữ.</span>
                                <br>
                                <img src="{{ asset(old('avatar_image')) }}" alt="" class="img-fluid avatar-img" width="100px" height="100px">
                            </div>
                            <div class="col-12 mt-4 text-right">
                                <button class="btn btn-lg btn-primary">Thêm ngôn ngữ</button>
                                <button class="btn btn-lg btn-primary">Làm lại</button>
                            </div>
                       </div>
                   </form>
                </div>
            </div>
            <div class="card">
                    <div class="card-header">
                        <i class="fa fa-list fa-lg mr-2"></i>Danh sách ngôn ngữ
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Ngôn ngữ</th>
                                    <th scope="col">Mã ngôn ngữ</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Hiển thị</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($languages as $key => $language)
                                    <tr class="text-center nb-row nb-tr-{{ $language->id }}" data-url="{{ route('config.language.status') }}">
                                        <td>{{ $language->id }}</td>
                                        <td class="nb-edit-name-{{ $key }} text-center" >{{ $language->name }}</td>
                                        <td class="nb-edit-link-{{ $key }} text-center" >{{ $language->name_code }}</td>
                                        <td class="nb-edit-icon-{{ $key }} text-center" data-img="{{ asset($language->avatar_image) }}"><img src="{{ asset($language->avatar_image) }}" alt="" width="30px" height="20px"></td>
                                        <td>
                                            @if ($language->publish)
                                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $language->id }}" title="Status" data-name="publish">
                                                    <i class="fa fa-check fa-lg text-success"></i>
                                                </span>
                                            @else
                                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $language->id }}" title="Status"  data-name="publish">
                                                    <i class="fa fa-remove fa-lg text-secondary"></i>
                                                </span>
                                            @endif</td>
                                        <td>
                                            <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $language->id }}" data-url="{{ route('config.language.remove') }}">
                                                <i class="fa fa-trash text-danger nb-cta-action "></i>
                                            </a>
                                            <a href="void:javascript(0)" title="Edit" class="nb-edit-{{ $key }}" data-id="{{ $language->id }}" data-url="{{ route('config.language.update') }}"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>

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
    @include('partials.admin.modal_gallery')
@endsection

@section('script')
    <script>
        $(function(){
            // click avatar_image open filemanager
            $('.browser2').click(function(){
                var input_id2 = $('.browser2').attr('data-name-type');
                $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input_id2+'&akey='+akey+'") !!}');
            })

            // show image
            $('#modal-file').on('hidden.bs.modal', function (e) {
                // show avatar_image
                var url_avatar_img = $('#avatar_image').val();
                $('.avatar-img').attr('src', url_avatar_img);

            });



            for (let index = 0; index < $('.nb-row').length; index++) {

                $('.nb-edit-'+index).click(function(){
                    var vname = $('.nb-edit-name-' + index).text()
                    var vlink = $('.nb-edit-link-' + index).text()
                    var vicon = $('.nb-edit-icon-' + index).attr('data-img')

                    var id = $(this).attr('data-id')
                    var url = $(this).attr('data-url')
                    $('.nb-edit-name-' + index).html('<input type="text" class="form-control nb-input-name-'+id+'" placeholder="Nhập tên ngôn ngữ" value="'+vname+'"/>')
                    $('.nb-edit-link-' + index).html('<input type="text" class="form-control nb-input-link-'+id+'" placeholder="Nhập mã ngôn ngữ" value="'+vlink+'"/>')
                    $('.nb-edit-icon-' + index).html('<div class="row"><div class="col-8"><input type="text" class="form-control nb-input-icon-'+id+' avatar_image" id="avatar_image_'+id+'" placeholder="Chọn hình ảnh" value="'+vicon+'"/></div><div class="col-4"><button type="button" class="btn btn-primary browser-'+id+'" data-toggle="modal" data-target="#modal-file" type="button" data-name-type="avatar_image_'+id+'">Browser</button></div></div>')
                    $('.nb-edit-' + index).css('display', 'none')
                    $('.nb-save-' + index).css('display', 'inline-block')
                    $('.nb-delete-' + index).css('display', 'none')

                    $('.browser-'+id).click(function(){
                        var input = $('.browser-'+id).attr('data-name-type');
                        console.log(input)
                        $('#filemanager').attr('src', '{!! asset("file/dialog.php?type=1&field_id='+input+'&akey='+akey+'") !!}');
                    })

                    console.log(vname)
                    console.log(vlink)
                    console.log(vicon)


                    $('.nb-save-'+index).click(function(){

                        var name = $('.nb-input-name-'+id).val();
                        var link = $('.nb-input-link-'+id).val();
                        var icon = $('.nb-input-icon-'+id).val();
                        var base_url = window.location.origin;
                        axios.post(url, {
                            name: name,
                            link: link,
                            icon: icon,
                            id: id,
                        })
                        .then(function(response){
                            $('.nb-edit-name-' + index).text(response.data.name)
                            $('.nb-edit-link-' + index).text(response.data.name_code)
                            $('.nb-edit-icon-' + index).html('<img src="'+base_url + response.data.avatar_image+'">')
                            $('.nb-edit-' + index).css('display', 'inline-block')
                            $('.nb-save-' + index).css('display', 'none')
                            $('.nb-delete-' + index).css('display', 'inline-block')
                            toastr.success('Cập nhật thành công.');

                        })
                        .catch(function(error){
                            console.log(error)
                        })
                    })
                })
            }
        })
    </script>
@endsection

