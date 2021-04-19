<section id="button_submit">
    <button class="btn btn-primary" type="submit" name="back" value="back">
        {{ Request::segment(5) == 'create' ? "Lưu lại và thêm mới" : "Lưu" }}
    </button>
    <button class="btn btn-primary" type="submit" name="close" value="close">Lưu lại và thoát</button>
    <button class="btn btn-primary" type="reset">Làm lại</button>
</section>