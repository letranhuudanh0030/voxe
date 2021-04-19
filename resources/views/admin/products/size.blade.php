@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
    <section id="nb-size-color">
        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-info-circle fa-lg mr-2"></i>Thông tin chung
                </div>
                <div class="card-body">
                   <form action="{{ route('size.create') }}" method="POST">
                       @csrf
                       <div class="form-row">

                           <div class="col">
                               <label for="">Size <span class="text-danger">(*)</span>: </label>
                               <input type="text" name="name" id="" class="form-control" placeholder="ví dụ: size L">
                           </div>
                           <div class="col">
                                <label for="">Mã size:</label>
                                <input type="text" name="code" id="" class="form-control" placeholder="ví dụ: L">
                            </div>
                            <div class="col-12 mt-4 text-right">
                                <button class="btn btn-lg btn-primary">Thêm size</button>
                                <button class="btn btn-lg btn-primary">Làm lại</button>
                            </div>
                       </div>
                   </form>
                </div>
            </div>
            <div class="card">
                    <div class="card-header">
                        <i class="fa fa-list fa-lg mr-2"></i>Danh sách size
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Mã</th>
                                    <th scope="col">Hiển thị</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sizes as $key => $size)
                                    <tr class="text-center nb-row nb-tr-{{ $size->id }}" data-url="{{ route('size.status') }}">
                                        <td>{{ $size->id }}</td>
                                        <td class="nb-edit-name-{{ $key }} text-left" >{{ $size->title }}</td>
                                        <td class="nb-edit-code-{{ $key }} text-left">{{  $size->code  }}</td>
                                        <td>
                                            @if ($size->publish)
                                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $size->id }}" title="Status" data-name="publish">
                                                    <i class="fa fa-check fa-lg text-success"></i>
                                                </span>
                                            @else
                                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $size->id }}" title="Status"  data-name="publish">
                                                    <i class="fa fa-remove fa-lg text-secondary"></i>
                                                </span>
                                            @endif</td>
                                        <td>
                                            <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $size->id }}" data-url="{{ route('size.remove') }}">
                                                <i class="fa fa-trash text-danger nb-cta-action "></i>
                                            </a>
                                            <a href="void:javascript(0)" title="Edit" class="nb-edit-{{ $key }}" data-id="{{ $size->id }}" data-url="{{ route('size.update') }}"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>

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
                    var vcode = $('.nb-edit-code-' + index).text()
                    // var vicon = $('.nb-edit-icon-' + index).text()

                    var id = $(this).attr('data-id')
                    var url = $(this).attr('data-url')




                    $('.nb-edit-name-' + index).html('<input type="text" class="form-control nb-input-name-'+id+'" placeholder="Nhập Size" value="'+vname+'"/>')
                    $('.nb-edit-code-' + index).html('<input type="text" class="form-control nb-input-code-'+id+'" placeholder="Nhập mã size" value="'+vcode+'"/>')
                    // $('.nb-edit-icon-' + index).html('<input type="text" class="form-control nb-input-icon-'+id+'" placeholder="Nhập icon mạng xã hội" value="'+vicon+'"/>')

                    $('.nb-edit-' + index).css('display', 'none')
                    $('.nb-save-' + index).css('display', 'inline-block')
                    $('.nb-delete-' + index).css('display', 'none')


                    $('.nb-save-'+index).click(function(){

                        var name = $('.nb-input-name-'+id).val();
                        var code = $('.nb-input-code-'+id).val();
                        // var icon = $('.nb-input-icon-'+id).val();
                        axios.post(url, {
                            name: name,
                            code: code,
                            // icon: icon,
                            id: id,
                        })
                        .then(function(response){
                            $('.nb-edit-name-' + index).text(response.data.title)
                            $('.nb-edit-code-' + index).text(response.data.code)
                            $('.nb-edit-code-' + index).css('background', response.data.code)
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

                })
            }
        })
    </script>
@endsection

