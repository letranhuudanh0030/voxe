<section id="seo">
    <div class="form-group">
        <label for="">Title: 70 kí tự</label>
        <input type="text" class="form-control" placeholder="Nhập tiêu đề sản phẩm" name="meta_title" value="{{ old('meta_title', isset($aItem) ? $aItem->meta_title : "") }}">
    </div>
    <div class="form-group">
        <label for="">Slug:</label>
        <input type="text" class="form-control" placeholder="Nhập link slug (nếu có)" name="slug" value="{{ old('slug', isset($aItem) ? $aItem->slug : "") }}">
    </div>
    <div class="form-group">
        <label for="">Keywords: 70 kí tự</label>
        <input type="text" class="form-control" placeholder="Nhập các từ khóa cho SEO" name="meta_keywords" value="{{ old('meta_keywords', isset($aItem) ? $aItem->meta_keywords : "") }}">
    </div>
    <div class="form-group">
        <label for="">Description: 160 kí tự</label>
        <textarea id="" cols="30" rows="5" class="form-control" name="meta_desc">{{ old('meta_desc', isset($aItem) ? $aItem->meta_desc : "") }}</textarea>
    </div>
</section>