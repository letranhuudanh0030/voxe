<div id="contactTrans" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="categoryTrans" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="card">
            <div class="card-header">
                Nội dung ngôn ngữ
                <button class="btn-primary float-right add-lang" type="button"><i class="fa fa-plus"></i></button>
            </div>
            {{-- <form action=""> --}}
                <div class="card-body">
                    <div class="form-lang">
                        @if ($configContact)
                            @foreach ($configContact->language as $key => $item)
                            <div class="card language language-edit-{{ $key }}">
                                <div class="card-header">Ngôn ngữ <button class="btn-danger float-right remove-lang-{{ $key }}" type="button"><i class="fa fa-minus"></i></button></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="config_contact_footer_lang">[Liên hệ] - Footer:</label>
                                        <textarea id="config_contact_footer_lang" cols="30" rows="5" class="form-control config_content" name="config_contact_footer_lang[]" placeholder="Nhập liên hệ footer ngôn ngữ mới">{{ $item->pivot->footer }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="config_work_footer_lang">[Map] - Footer:</label>
                                        <textarea id="config_work_footer_lang" cols="30" rows="5" class="form-control config_content" name="config_work_footer_lang[]" placeholder="Nhập nội dung ngôn ngữ mới">{{ $item->pivot->work_footer }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="config_commit_footer_lang">[Thêm] - Footer:</label>
                                        <textarea id="config_commit_footer_lang" cols="30" rows="5" class="form-control config_content" name="config_commit_footer_lang[]" placeholder="Nhập nội dung ngôn ngữ mới">{{ $item->pivot->commit_footer }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="config_contact_page_lang">[Liên hệ] - Trang liên hệ:</label>
                                        <textarea id="config_contact_page_lang" cols="30" rows="5" class="form-control config_content" name="config_contact_page_lang[]" placeholder="Nhập nội dung ngôn ngữ mới">{{ $item->pivot->contact_page }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="config_content_support_lang">Hỗ trợ trực tuyến:</label>
                                        <textarea id="config_content_support_lang" cols="30" rows="5" class="form-control config_content" name="config_content_support_lang[]" placeholder="Nhập nội dung ngôn ngữ mới">{{ $item->pivot->support }}</textarea>
                                    </div>
                                    <div class="form-group">
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
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            {{-- </form> --}}
        </div>
        </div>
    </div>
</div>

<script>
    var OpenFormGroup = '<div class="form-group">'
    var CloseDiv = '</div>'
    var OpenLabel = '<label>'
    var CloseLabel = '</label>'
    // console.log({{ $languages }})

    var index = 1
    $('.add-lang').click(function(){
        //
        let form = ''
        form += '<div class="card language-'+ index +'">'
        form += '<div class="card-header">Ngôn ngữ '+ index +'<button class="btn-danger float-right remove-lang-'+ index +'" type="button"><i class="fa fa-minus"></i></button></div>'
        form += '<div class="card-body">'
        form += OpenFormGroup
        form += '<label for="config_contact_footer_lang'+ index +'">[Liên hệ] - Footer:</label>'
        form += '<textarea id="config_contact_footer_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="config_contact_footer_lang[]" placeholder="Nhập liên hệ footer ngôn ngữ mới"></textarea>'
        form += CloseDiv
        form += OpenFormGroup
        form += '<label for="config_work_footer_lang'+ index +'">[Map] - Footer:</label>'
        form += '<textarea id="config_work_footer_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="config_work_footer_lang[]" placeholder="Nhập nội dung ngôn ngữ mới"></textarea>'
        form += CloseDiv
        form += OpenFormGroup
        form += '<label for="config_commit_footer_lang'+ index +'">[Thêm] - Footer:</label>'
        form += '<textarea id="config_commit_footer_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="config_commit_footer_lang[]" placeholder="Nhập nội dung ngôn ngữ mới"></textarea>'
        form += CloseDiv
        form += OpenFormGroup
        form += '<label for="config_contact_page_lang'+ index +'">[Liên hệ] - Trang liên hệ:</label>'
        form += '<textarea id="config_contact_page_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="config_contact_page_lang[]" placeholder="Nhập nội dung ngôn ngữ mới"></textarea>'
        form += CloseDiv
        form += OpenFormGroup
        form += '<label for="config_content_support_lang'+ index +'">Hỗ trợ trực tuyến:</label>'
        form += '<textarea id="config_content_support_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="config_content_support_lang[]" placeholder="Nhập nội dung ngôn ngữ mới"></textarea>'
        form += CloseDiv

        form += OpenFormGroup
        form += '<label for="language'+ index +'">Ngôn ngữ:</label>'
        form += '<select name="language[]" id="language'+ index +'" class="form-control">'
            @foreach ($languages as $lang)
            form += '<option value="{{ $lang->id }}">{{ $lang->name }}</option>'
            @endforeach
        form += '</select>'
        form += CloseDiv
        form += '</div>'
        form += '</div>'

        index++
        $('.form-lang').after(form)

        for (let i = 1; i < index; i++) {
            if($('.language-'+ i).length){
                $('.remove-lang-'+ i).click(function(){
                    $('.language-'+ i).remove()
                })
            }
        }

        initTextarea()

    })

    for (let i = 0; i < $('.language').length; i++) {
        if($('.language-edit-'+ i).length){
            $('.remove-lang-'+ i).click(function(){
                $('.language-edit-'+ i).remove()
            })
        }

    }
</script>

