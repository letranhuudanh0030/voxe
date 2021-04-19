@extends('layouts.master')
@section('content')
@include('partials.admin.header_content')
<section id="question">
    <div class="container-fluid mt-4">
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="table-info text-center">
                    <th scope="col">Mã</th>
                    <th scope="col">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="check-all">
                            <label class="custom-control-label" for="check-all"></label>
                        </div>
                    </th>
                    <th scope="col">Câu hỏi</th>
                    <th scope="col">Câu trả lời</th>
                    <th scope="col">Hiển thị</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $key => $question)                   
                    <tr class="text-center nb-tr-{{ $question->id }}"
                        data-url="{{ route('question.status') }}">
                        <td>{{ $question->id }}</td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="check-{{ $key }}"
                                    data-id="{{ $question->id }}">
                                <label class="custom-control-label" for="check-{{ $key }}"></label>
                            </div>
                        </td>
                        <td class="text-left">{{ $question->question }}</td>
                        <td class="text-left">
                            {!! $question->anwser !!}
                        </td>
                        <td>
                            @if($question->publish)
                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="0"
                                    id="{{ $question->id }}" title="Status" data-name="publish">
                                    <i class="fa fa-check fa-lg text-success"></i>
                                </span>
                            @else
                                <span class="nb-check-publish-{{ $key }} nb-check nb-publish-status" data-change="1"
                                    id="{{ $question->id }}" title="Status" data-name="publish">
                                    <i class="fa fa-remove fa-lg text-secondary"></i>
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="void:javascript(0)" title="Delete" class="nb-row-{{ $key }} nb-delete"
                                data-id="{{ $question->id }}" data-url="{{ route('question.remove') }}">
                                <i class="fa fa-trash text-danger nb-cta-action "></i>
                            </a>
                            <a href="{{ route('question.edit', $question->id) }}" title="Edit"><i
                                    class="fa fa-pencil-square text-orange nb-cta-action"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <div class="float-right">
                <a href="void:javascript(0)" class="btn btn-danger nb-delete-all mb-4" data-ids="" data-url="{{ route('question.remove.all') }}"><i class="fa fa-trash fa-lg text-white"></i>&nbsp; Xóa hết</a>
            </div>
        </table>
    </div>
</section>
<!-- Modal -->
@include('partials.admin.modal_delete')
@include('partials.admin.modal_delete_all')
@endsection
