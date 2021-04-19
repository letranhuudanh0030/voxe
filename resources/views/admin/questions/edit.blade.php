@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
<section id="nb-create-article">
    <div class="container-fluid mt-3">
        <form action="{{ route('question.update', $question->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-info-circle"></i> Thông tin chung
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Câu hỏi<span class="text-danger"></span>:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="question" value="{{ old('question', $question->question)   }}">
                                    <span class="text-small text-gray help-block-none">Nhập câu hỏi.</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Câu trả lời<span class="text-danger"></span>:</label>
                                <div class="col-sm-10">
                                    <textarea name="anwser" id="anwser" cols="30" rows="10" class="form-control config_content">{{ old('anwser', $question->anwser) }}</textarea>
                                    <span class="text-small text-gray help-block-none">Nhập câu trả lời.</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Thao tác</label>
                                <div class="col-sm-10 mb-3">
                                    <button class="btn btn-primary" type="submit" name="close" value="close">Lưu lại và thoát</button>
                                    <button class="btn btn-primary" type="submit" name="back" value="back">Lưu lại và thêm mới</button>
                                    <button class="btn btn-primary" type="reset">Làm lại</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-gift fa-lg"></i> Tùy chọn
                        </div>
                        <div class="card-body">
                            <div class="form-group d-flex">
                                <div class="form-check-inline nb-create-article-category-title-op">
                                    <label class="form-control-label ">Hiển thị:</label>
                                </div>
                                <div>
                                    <div class="form-check-inline mb-1">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="publish" value="0" @if (!$question->publish)
                                            checked
                                        @endif>
                                            <span class="bg-secondary nb-check text-white">Không</span>
                                        </label>
                                    </div>
                                    <div class="form-check-inline mb-1 ">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input " name="publish" value="1" @if ($question->publish)
                                            checked
                                        @endif>
                                            <span class="bg-success text-white nb-check">Có</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group d-flex">
                                <div class="form-check-inline nb-create-article-category-title-op">
                                    <label class="form-control-label ">Ngôn ngữ:</label>
                                </div>
                                <div>
                                    <div class="form-check-inline mb-1">
                                        <a href="void:javascript(0)" class="btn btn-primary text-decoration-none trans">Nội dung</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @include('partials.admin.modal_question')
        </form>
    </div>
</section>
@endsection

@section('script')
    <script>
        $(function () {
            $('.trans').click(function(){
                $('#modal-question').modal()
            })
        });
    </script>
@endsection




