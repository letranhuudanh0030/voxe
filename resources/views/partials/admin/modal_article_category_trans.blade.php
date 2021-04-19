<div id="categoryTrans" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="categoryTrans" aria-hidden="true">
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
                            @if ($articleCategory)
                                @foreach ($articleCategory->language as $key => $item)
                                <div class="card language language-edit-{{ $key }}">
                                    <div class="card-header">Ngôn ngữ <button class="btn-danger float-right remove-lang-{{ $key }}" type="button"><i class="fa fa-minus"></i></button></div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name_lang">Tên danh mục:</label>
                                            <input type="text" id="name_lang" name="name_lang[]" class="form-control" placeholder="Nhập tên danh mục ngôn ngữ mới" value="{{ $item->pivot->title }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="short_desc_lang">Mô tả ngắn:</label>
                                            {{-- <input type="text" id="short_desc_lang" name="short_desc_lang[]" class="form-control" placeholder="Nhập mô tả ngắn ngôn ngữ mới" value="{{ $item->pivot->short_desc }}"> --}}
                                            <textarea id="short_desc_lang" cols="30" rows="10" class="form-control config_content" name="short_desc_lang[]" placeholder="Nhập mô tả ngắn ngôn ngữ mới">{{ $item->pivot->short_desc }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_title_lang">Title seo:</label>
                                            <input type="text" id="meta_title_lang" name="meta_title_lang[]" class="form-control" placeholder="Nhập tiêu đề seo ngôn ngữ mới" value="{{ $item->pivot->meta_title }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_desc_lang">Description seo:</label>
                                            {{-- <input type="text" id="meta_desc_lang" name="meta_desc_lang[]" class="form-control" placeholder="Nhập mô tả seo ngôn ngữ mới" value="{{ $item->pivot->meta_desc }}"> --}}
                                            <textarea id="meta_desc_lang" cols="30" rows="10" class="form-control config_content" name="meta_desc_lang[]" placeholder="Nhập mô tả seo ngôn ngữ mới">{{ $item->pivot->meta_desc }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keyword_lang">Keyword seo:</label>
                                            <input type="text" id="meta_keyword_lang" name="meta_keyword_lang[]" class="form-control" placeholder="Nhập từ khóa seo ngôn ngữ mới" value="{{ $item->pivot->meta_keyword }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug_lang">Slug:</label>
                                            <input type="text" id="slug_lang" name="slug_lang[]" class="form-control" placeholder="Nhập slug ngôn ngữ mới" value="{{ $item->pivot->slug }}">
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
            let form = ''
            form += '<div class="card language-'+ index +'">'
            form += '<div class="card-header">Ngôn ngữ '+ index +'<button class="btn-danger float-right remove-lang-'+ index +'" type="button"><i class="fa fa-minus"></i></button></div>'
            form += '<div class="card-body">'
            form += OpenFormGroup
            form += '<label for="name_lang'+ index +'">Tên danh mục:</label>'
            form += '<input type="text" id="name_lang'+ index +'" name="name_lang[]" class="form-control" placeholder="Nhập tên danh mục ngôn ngữ mới">'
            form += CloseDiv
            form += OpenFormGroup
            form += '<label for="short_desc_lang'+ index +'">Mô tả ngắn:</label>'
            form += '<textarea id="short_desc_lang'+ index +'" cols="30" rows="10" class="form-control config_content" name="short_desc_lang[]" placeholder="Nhập mô tả ngắn ngôn ngữ mới"></textarea>'
            form += CloseDiv
            form += OpenFormGroup
            form += '<label for="meta_title_lang'+ index +'">Title seo:</label>'
            form += '<input type="text" id="meta_title_lang'+ index +'" name="meta_title_lang[]" class="form-control" placeholder="Nhập tiêu đề seo ngôn ngữ mới">'
            form += CloseDiv
            form += OpenFormGroup
            form += '<label for="meta_desc_lang'+ index +'">Description seo:</label>'
            form += '<textarea id="meta_desc_lang'+ index +'" cols="30" rows="10" class="form-control config_content" name="meta_desc_lang[]" placeholder="Nhập mô tả seo ngôn ngữ mới"></textarea>'
            form += CloseDiv
            form += OpenFormGroup
            form += '<label for="meta_keyword_lang'+ index +'">Keyword seo:</label>'
            form += '<input type="text" id="meta_keyword_lang'+ index +'" name="meta_keyword_lang[]" class="form-control" placeholder="Nhập từ khóa seo ngôn ngữ mới">'
            form += CloseDiv
            form += OpenFormGroup
            form += '<label for="slug_lang'+ index +'">Slug:</label>'
            form += '<input type="text" id="slug_lang'+ index +'" name="slug_lang[]" class="form-control" placeholder="Nhập slug ngôn ngữ mới">'
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

