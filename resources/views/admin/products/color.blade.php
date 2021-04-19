@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
<link rel="stylesheet" href="{{ asset('admin_source/colorPicker/light.min.css') }}">
    <section id="nb-product-color">
        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-info-circle fa-lg mr-2"></i>Thông tin chung
                </div>
                <div class="card-body">
                   <form action="{{ route('color.create') }}" method="POST">
                       @csrf
                       <div class="form-row">

                           <div class="col">
                               <label for="">Màu sắc <span class="text-danger">(*)</span>: </label>
                               <input type="text" name="name" id="" class="form-control" placeholder="ví dụ: màu đỏ">
                           </div>
                           <div class="col">
                                {{-- <label for="">Code màu sắc: ( <a href="https://flatuicolors.com/" target="_blank">truy cập để lấy mã màu</a> )</label>
                                <input type="text" name="link" id="" class="form-control" placeholder="ví dụ: #ff0000"> --}}
                                <label for="dc-ex4">Mã màu: </label>
                                <span class="colorpicker-input colorpicker-input--position-left">
                                    <input id="product-color" type="text" class="form-control colorpicker-anchor"  name="product_color">
                                    <span id="dc-ex4-anchor" class="colorpicker-custom-anchor colorpicker-circle-anchor">
                                        <span data-color="" class="colorpicker-circle-anchor__color">
                                        </span>
                                    </span>
                                </span>
                                <small class="form-text text-muted">Định dạng: <code>rgba</code></small>
                            </div>
                            <div class="col-12 mt-4 text-right">
                                <button class="btn btn-lg btn-primary">Thêm màu</button>
                                <button class="btn btn-lg btn-primary">Làm lại</button>
                            </div>
                       </div>
                   </form>
                </div>
            </div>
            <div class="card">
                    <div class="card-header">
                        <i class="fa fa-list fa-lg mr-2"></i>Danh sách màu sắc
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered text-center">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Màu sắc</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Hiển thị</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($colors as $key => $color)
                                    <tr class="text-center nb-row nb-tr-{{ $color->id }}" data-url="{{ route('color.status') }}">
                                        <td>{{ $color->id }}</td>
                                        <td class="nb-edit-name-{{ $key }} text-left" >{{ $color->title }}</td>
                                        <td class="nb-edit-code-{{ $key }} text-left" style="background: {{  $color->code  }}">{{  $color->code  }}</td>
                                        <td>
                                            @if ($color->publish)
                                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0" id="{{ $color->id }}" title="Status" data-name="publish">
                                                    <i class="fa fa-check fa-lg text-success"></i>
                                                </span>
                                            @else
                                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1" id="{{ $color->id }}" title="Status"  data-name="publish">
                                                    <i class="fa fa-remove fa-lg text-secondary"></i>
                                                </span>
                                            @endif</td>
                                        <td>
                                            <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete" data-id="{{ $color->id }}" data-url="{{ route('color.remove') }}">
                                                <i class="fa fa-trash text-danger nb-cta-action "></i>
                                            </a>
                                            <a href="void:javascript(0)" title="Edit" class="nb-edit-{{ $key }}" data-id="{{ $color->id }}" data-url="{{ route('color.update') }}"><i class="fa fa-pencil-square text-orange nb-cta-action"></i></a>

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
    <script src="{{ asset('admin_source/colorPicker/default-picker.min.js') }}"></script>
    <script>
        $(function(){


            var colorPicker = new ColorPicker.Default('#product-color', {
                placement: "bottom",
                // color: "{{ $color_menu[0] }}"
                // hexOnly: true
            });


            for (let index = 0; index < $('.nb-row').length; index++) {

                $('.nb-edit-'+index).click(function(){
                    var vname = $('.nb-edit-name-' + index).text()
                    var vcode = $('.nb-edit-code-' + index).text()
                    // var vicon = $('.nb-edit-icon-' + index).text()

                    var id = $(this).attr('data-id')
                    var url = $(this).attr('data-url')




                    $('.nb-edit-name-' + index).html('<input type="text" class="form-control nb-input-name-'+id+'" placeholder="Nhập màu sắc" value="'+vname+'"/>')
                    $('.nb-edit-code-' + index).html('<span class="colorpicker-input colorpicker-input--position-left"><input id="product-color-'+id+'" type="text" class="form-control colorpicker-anchor nb-input-code-'+id+'"  name="product_color_'+id+'" value="'+vcode+'"><span id="dc-ex4-anchor-'+id+'" class="colorpicker-custom-anchor colorpicker-circle-anchor"><span data-color="" class="colorpicker-circle-anchor__color"></span></span></span>')
                    // $('.nb-edit-icon-' + index).html('<input type="text" class="form-control nb-input-icon-'+id+'" placeholder="Nhập icon mạng xã hội" value="'+vicon+'"/>')

                    $('.nb-edit-' + index).css('display', 'none')
                    $('.nb-save-' + index).css('display', 'inline-block')
                    $('.nb-delete-' + index).css('display', 'none')


                    var colorPicker = new ColorPicker.Default('#product-color-' + id, {
                        placement: "top",
                        color: vcode
                        // hexOnly: true
                    });

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

