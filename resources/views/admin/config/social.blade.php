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
                   <form action="{{ route('config.social.create') }}" method="POST">
                       @csrf
                       <div class="form-row">

                           <div class="col">
                               <label for="">Tên mạng xã hội <span class="text-danger">(*)</span>: </label>
                               <input type="text" name="name" id="" class="form-control" placeholder="ví dụ: facebook">
                           </div>
                           <div class="col">
                                <label for="">Link mạng xã hội: </label>
                                <input type="text" name="link" id="" class="form-control" placeholder="ví dụ: facebook.com">
                            </div>
                            <div class="col">
                                <label for="">Icon mạng xã hội <span class="text-danger">(*)</span>: (<a href="https://fontawesome.com/v4.7.0/icons/" target="_blank">truy cập để lấy icon</a>)</label>
                                <input type="text" name="icon" id="" class="form-control" placeholder="ví dụ: fa fa-facebook">
                            </div>
                            <div class="col-12 mt-4 text-right">
                                <button class="btn btn-lg btn-primary">Thêm mạng xã hội</button>
                                <button class="btn btn-lg btn-primary">Làm lại</button>
                            </div>
                       </div>
                   </form>
                </div>
            </div>
            <div class="card">
                    <div class="card-header">
                        <i class="fa fa-list fa-lg mr-2"></i>Danh sách mạng xã hội
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Mạng xã hội</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Vị trí</th>
                                    <th scope="col">Hiển thị</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($socials as $key => $social)
                                    <tr class="text-center nb-row nb-tr-{{ $social->id }}" data-url="{{ route('config.social.status') }}">
                                        <td>{{ $social->id }}</td>
                                        <td class="nb-edit-name-{{ $key }} text-left" >{{ $social->name }}</td>
                                        <td class="nb-edit-link-{{ $key }} text-left" >{{ $social->link }}</td>
                                        <td class="nb-edit-icon-{{ $key }} text-left" >{{ $social->icon }}</td>
                                        <td><input type="text" class="nb-sort-order sort-order-{{ $key }}" value="{{ $social->sort_order }}" id="{{ $social->id }}" name="sort_order"></td>
                                        <td>
                                            @if ($social->publish)
                                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $social->id }}" title="Status" data-name="publish">
                                                    <i class="fa fa-check fa-lg text-success"></i>
                                                </span>
                                            @else
                                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $social->id }}" title="Status"  data-name="publish">
                                                    <i class="fa fa-remove fa-lg text-secondary"></i>
                                                </span>
                                            @endif</td>
                                        <td>
                                            <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $social->id }}" data-url="{{ route('config.social.remove') }}">
                                                <i class="fa fa-trash text-danger nb-cta-action "></i>
                                            </a>
                                            <a href="void:javascript(0)" title="Edit" class="nb-edit-{{ $key }}" data-id="{{ $social->id }}" data-url="{{ route('config.social.update') }}"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>

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
                    var vicon = $('.nb-edit-icon-' + index).text()

                    var id = $(this).attr('data-id')
                    var url = $(this).attr('data-url')
                    $('.nb-edit-name-' + index).html('<input type="text" class="form-control nb-input-name-'+id+'" placeholder="Nhập tên mạng xã hội" value="'+vname+'"/>')
                    $('.nb-edit-link-' + index).html('<input type="text" class="form-control nb-input-link-'+id+'" placeholder="Nhập link mạng xã hội" value="'+vlink+'"/>')
                    $('.nb-edit-icon-' + index).html('<input type="text" class="form-control nb-input-icon-'+id+'" placeholder="Nhập icon mạng xã hội" value="'+vicon+'"/>')
                    $('.nb-edit-' + index).css('display', 'none')
                    $('.nb-save-' + index).css('display', 'inline-block')
                    $('.nb-delete-' + index).css('display', 'none')

                    $('.nb-save-'+index).click(function(){

                        var name = $('.nb-input-name-'+id).val();
                        var link = $('.nb-input-link-'+id).val();
                        var icon = $('.nb-input-icon-'+id).val();
                        axios.post(url, {
                            name: name,
                            link: link,
                            icon: icon,
                            id: id,
                        })
                        .then(function(response){
                            $('.nb-edit-name-' + index).text(response.data.name)
                            $('.nb-edit-link-' + index).text(response.data.link)
                            $('.nb-edit-icon-' + index).text(response.data.icon)
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

