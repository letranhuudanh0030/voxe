<div id="categoryTrans" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="categoryTrans" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="card">
            <div class="card-header">
                Nội dung ngôn ngữ
                <button class="btn-primary float-right add-lang" type="button"><i class="fa fa-plus"></i></button>
            </div>
            <div class="card-body">
                <div class="form-lang">
                    @if ($estate)
                        @foreach ($estate->language as $key => $item)
                        <div class="card language language-edit-{{ $key }}">
                            <div class="card-header">Ngôn ngữ <button class="btn-danger float-right remove-lang-{{ $key }}" type="button"><i class="fa fa-minus"></i></button></div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="title_lang{{ $key }}">Tiêu đề:</label>
                                    <input type="text" id="title_lang{{ $key }}" name="title_lang[]" class="form-control" placeholder="Nhập tiêu đề ngôn ngữ mới" value="{{ $item->pivot->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="contact_lang{{ $key }}">Thông tin liên lạc:</label>
                                    <textarea id="contact_lang{{ $key }}" cols="30" rows="5" class="form-control config_content" name="contact_lang[]" placeholder="Nhập thông tin liên lạc ngôn ngữ mới">{{ $item->pivot->contact }}</textarea>
                                </div>
                                
                                @if ($estate->type_spec == 'f-dat-cong-nghiep')
                                  
                                    <div class="form-group">
                                        <label for="description_lang{{ $key }}">Mô tả nhà xưởng:</label>
                                        <textarea id="description_lang{{ $key }}" cols="30" rows="5" class="form-control config_content" name="description_lang[]" placeholder="Nhập mô tả nhà xưởng ngôn ngữ mới">{{ $item->pivot->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="condition_lang{{ $key }}">Điều kiện:</label>
                                        <textarea id="condition_lang{{ $key }}" cols="30" rows="5" class="form-control config_content" name="condition_lang[]" placeholder="Nhập điều kiện ngôn ngữ mới">{{ $item->pivot->condition }}</textarea>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="functional_subdivision_lang{{ $key }}">Điều kiện:</label>
                                        <textarea id="functional_subdivision_lang{{ $key }}" cols="30" rows="5" class="form-control config_content" name="functional_subdivision_lang[]" placeholder="Nhập điều kiện ngôn ngữ mới">{{ $item->pivot->functional_subdivision }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="infrastructure_lang{{ $key }}">Điều kiện:</label>
                                        <textarea id="infrastructure_lang{{ $key }}" cols="30" rows="5" class="form-control config_content" name="infrastructure_lang[]" placeholder="Nhập điều kiện ngôn ngữ mới">{{ $item->pivot->infrastructure }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="investment_costs_lang{{ $key }}">Điều kiện:</label>
                                        <textarea id="investment_costs_lang{{ $key }}" cols="30" rows="5" class="form-control config_content" name="investment_costs_lang[]" placeholder="Nhập điều kiện ngôn ngữ mới">{{ $item->pivot->investment_costs }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="career_lang{{ $key }}">Điều kiện:</label>
                                        <textarea id="career_lang{{ $key }}" cols="30" rows="5" class="form-control config_content" name="career_lang[]" placeholder="Nhập điều kiện ngôn ngữ mới">{{ $item->pivot->career }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="incentives_lang{{ $key }}">Điều kiện:</label>
                                        <textarea id="incentives_lang{{ $key }}" cols="30" rows="5" class="form-control config_content" name="incentives_lang[]" placeholder="Nhập điều kiện ngôn ngữ mới">{{ $item->pivot->suport }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="suport_lang{{ $key }}">Điều kiện:</label>
                                        <textarea id="suport_lang{{ $key }}" cols="30" rows="5" class="form-control config_content" name="suport_lang[]" placeholder="Nhập điều kiện ngôn ngữ mới">{{ $item->pivot->condition }}</textarea>
                                    </div>
                                @endif



                                <div class="form-group">
                                    <label for="meta_title_lang">Title seo:</label>
                                    <input type="text" id="meta_title_lang" name="meta_title_lang[]" class="form-control" placeholder="Nhập tiêu đề seo ngôn ngữ mới" value="{{ $item->pivot->meta_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_desc_lang">Description seo:</label>
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
                        @endforeach
                    @endif
                </div>
            </div>
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
        let selectedValue = $('.choose-estate').val()
        let form = ''
        form += '<div class="card language-'+ index +'">'
        form += '<div class="card-header">Ngôn ngữ '+ index +'<button class="btn-danger float-right remove-lang-'+ index +'" type="button"><i class="fa fa-minus"></i></button></div>'
        form += '<div class="card-body">'
        form += OpenFormGroup
        form += '<label for="title_lang'+ index +'">Tiêu đề:</label>'
        form += '<input type="text" id="title_lang'+ index +'" name="title_lang[]" class="form-control" placeholder="Nhập tiêu đề ngôn ngữ mới">'
        form += CloseDiv
        form += OpenFormGroup
        form += '<label for="contact_lang'+ index +'">Thông tin liên lạc:</label>'
        form += '<textarea id="contact_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="contact_lang[]" placeholder="Nhập thông tin liên lạc ngôn ngữ mới"></textarea>'
        form += CloseDiv
        
        if(selectedValue == 'f-dat-cong-nghiep'){
            form += OpenFormGroup
            form += '<label for="description_lang'+ index +'">Mô tả nhà xưởng:</label>'
            form += '<textarea id="description_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="description_lang[]" placeholder="Nhập mô tả nhà xưởng ngôn ngữ mới"></textarea>'
            form += CloseDiv

            form += OpenFormGroup
            form += '<label for="condition_lang'+ index +'">Điều kiện:</label>'
            form += '<textarea id="condition_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="condition_lang[]" placeholder="Nhập điều kiện ngôn ngữ mới"></textarea>'
            form += CloseDiv
        } else {
            form += OpenFormGroup
            form += '<label for="functional_subdivision_lang'+ index +'">Phân khu chức năng:</label>'
            form += '<textarea id="functional_subdivision_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="functional_subdivision_lang[]" placeholder="Nhập phân khu chức năng ngôn ngữ mới"></textarea>'
            form += CloseDiv
            form += OpenFormGroup
            form += '<label for="infrastructure_lang'+ index +'">Hạ tầng:</label>'
            form += '<textarea id="infrastructure_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="infrastructure_lang[]" placeholder="Nhập hạ tầng ngôn ngữ mới"></textarea>'
            form += CloseDiv
            form += OpenFormGroup
            form += '<label for="investment_costs_lang'+ index +'">Chi phí đầu tư:</label>'
            form += '<textarea id="investment_costs_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="investment_costs_lang[]" placeholder="Nhập chi phí đầu tư ngôn ngữ mới"></textarea>'
            form += CloseDiv
            form += OpenFormGroup
            form += '<label for="career_lang'+ index +'">Ngành nghề:</label>'
            form += '<textarea id="career_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="career_lang[]" placeholder="Nhập ngành nghề ngôn ngữ mới"></textarea>'
            form += CloseDiv
            form += OpenFormGroup
            form += '<label for="incentives_lang'+ index +'">Chính sách ưu đãi đầu tư:</label>'
            form += '<textarea id="incentives_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="incentives_lang[]" placeholder="Nhập chính sách ưu đãi đầu tư ngôn ngữ mới"></textarea>'
            form += CloseDiv
            form += OpenFormGroup
            form += '<label for="suport_lang'+ index +'">Hỗ trợ khách hàng:</label>'
            form += '<textarea id="suport_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="suport_lang[]" placeholder="Nhập hỗ trợ khách hàng ngôn ngữ mới"></textarea>'
            form += CloseDiv
        }
       


        form += OpenFormGroup
        form += '<label for="meta_title_lang'+ index +'">Title seo:</label>'
        form += '<input type="text" id="meta_title_lang'+ index +'" name="meta_title_lang[]" class="form-control" placeholder="Nhập tiêu đề seo ngôn ngữ mới">'
        form += CloseDiv
        form += OpenFormGroup
        form += '<label for="meta_desc_lang'+ index +'">Description seo:</label>'
        form += '<textarea id="meta_desc_lang'+ index +'" cols="30" rows="5" class="form-control config_content" name="meta_desc_lang[]" placeholder="Nhập mô tả seo ngôn ngữ mới"></textarea>'
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

