<div id="modal-question" class=" modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card text-left">
                <div class="card-header text-right">
                    <button class="btn btn-primary add-question" type="button"><i
                            class="fa-lg fa fa-plus text-white"></i></button>
                </div>
                <div class="card-body px-4">
                    <div class="qa-form">
                        @if (isset($question))
                            @foreach ($question->language as $key => $item)
                                <div class="card language language-edit-{{ $key }}">
                                    <div class="card-header">
                                        <span class="text-uppercase">Câu hỏi thường gặp </span>
                                        <button class="btn-danger float-right remove-lang-" type="button"><i class="fa fa-minus"></i></button>
                                    </div>
                                    <div class="form-group px-4">
                                        <label>Câu hỏi</label>
                                        <input class="form-control" name="question_lang[]" placeholder="" value="{{ $item->pivot->question }}"/>

                                    </div>
                                    <div class="form-group px-4">
                                        <label>Trả lời</label>
                                        <textarea class="form-control config_content" name="anwser_lang[]" placeholder="">{{ $item->pivot->anwser }}</textarea>
                                    </div>  
                                    <div class="form-group px-4">
                                        <label for="language">Ngôn ngữ:</label>
                                        <select name="language[]" id="language" class="form-control">
                                            @forelse ($languages as $lang)
                                                <option value="{{ $lang->id }}" {{ $lang->id == $item->pivot->language_id ? 'selected' : '' }}>{{ $lang->name }}</option>
                                            @empty
                                                <option value="">Không có ngôn ngữ khác</option>
                                            @endforelse
                                        </select>
                                    </div>                              
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        var index = 1;
        $('.add-question').click(function(){
            let qa = ''
            qa += '<div class="card language-'+index+'">'
            qa += '<div class="card-header">'
            qa += '<span class="text-uppercase">Câu hỏi thường gặp ' + index + '</span>'
            qa += '<button class="btn-danger float-right remove-lang-'+ index +'" type="button"><i class="fa fa-minus"></i></button>'
            qa += '</div>'
            qa += '<div class="form-group px-4">'
            qa += '<label>Câu hỏi</label>'
            qa += '<input class="form-control" name="question_lang[]" placeholder="Nhập tiếng anh"></input>'
            qa += '</div>'
            qa += '<div class="form-group px-4">'
            qa += '<label>Trả lời</label>'
            qa += '<textarea class="form-control config_content" name="anwser_lang[]" placeholder="Nhập tiếng anh"></textarea>'
            qa += '</div>'
            qa += '<div class="form-group px-4">'
            qa += '<label for="language'+ index +'">Ngôn ngữ:</label>'
            qa += '<select name="language[]" id="language'+ index +'" class="form-control">'
                @foreach ($languages as $lang)
                    qa += '<option value="{{ $lang->id }}">{{ $lang->name }}</option>'
                @endforeach
            qa += '</select>'
            qa += '</div>'
            qa += '</div>'
            index++
            $('.qa-form').after(qa)

            for (let i = 1; i < index; i++) {
                if($('.language-'+ i).length){
                    $('.remove-lang-'+ i).click(function(){
                        $('.language-'+ i).remove()
                    })
                }
            }

            initTextarea()
        })

        for (let i = 1; i < $('.language').length; i++) {
            if($('.language-edit-'+ i).length){
                $('.remove-lang-'+ i).click(function(){
                    $('.language-edit-'+ i).remove()
                })
            }
        }


    })
</script>