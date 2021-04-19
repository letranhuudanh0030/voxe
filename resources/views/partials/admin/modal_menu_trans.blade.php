<div id="menuTrans" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="menuTrans" aria-hidden="true">
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
                        @if ($menu)
                            @foreach ($menu->language as $key => $item)
                            <div class="card language language-edit-{{ $key }}">
                                <div class="card-header">Ngôn ngữ <button class="btn-danger float-right remove-lang-{{ $key }}" type="button"><i class="fa fa-minus"></i></button></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title_lang">Tiêu đề:</label>
                                        <input type="text" id="title_lang" name="title_lang[]" class="form-control" placeholder="Nhập tiêu đề ngôn ngữ mới" value="{{ $item->pivot->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="url_lang">Url:</label>
                                        <input type="text" id="url_lang" name="url_lang[]" class="form-control" placeholder="Nhập url ngôn ngữ mới" value="{{ $item->pivot->url }}">
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
        form += '<label for="title_lang'+ index +'">Tiêu đề :</label>'
        form += '<input type="text" id="title_lang'+ index +'" name="title_lang[]" class="form-control" placeholder="Nhập tiêu đề ngôn ngữ mới">'
        form += CloseDiv
        form += OpenFormGroup
        form += '<label for="url_lang'+ index +'">Url:</label>'
        form += '<div class="row"><div class="col-9">'
        form += '<input type="text" id="url_lang'+ index +'" name="url_lang[]" class="form-control popupWindowLanguage" placeholder="Nhập url ngôn ngữ mới">'
        form += '</div><div class="col-3">'
        form += '<button class="btn btn-primary btn-get-link" type="button">Lấy link bài viết</button>'
        form += '</div>'
        form += '</div>'
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

        $('.btn-get-link').click(function (event) {
            event.preventDefault();
            var w = window.open("{{ route('post.index') }}", "popupWindowLanguage", "width=1150, height=600, scrollbars=yes");
        });

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

