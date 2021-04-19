<section id="options">
    <div class="form-group d-flex">
        <div class="form-check-inline nb-create-article-category-title-op">
            <label class="form-control-label ">Hiển thị:</label>
        </div>
        <div>
            <div class="form-check-inline mb-1">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input " name="publish" value="0" {{ isset($aItem) ? (!$aItem->publish ? "checked" : "") : "checked" }}>
                    <span class="bg-secondary nb-check text-white">Không</span>
                </label>
            </div>
            <div class="form-check-inline mb-1 ">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input " name="publish" value="1" {{ isset($aItem) ? ($aItem->publish ? "checked" : "") : "" }}>
                    <span class="bg-success text-white nb-check" >Có</span>
                </label>
            </div>
        </div>

    </div>
    <div class="form-group d-flex">
        <div class="form-check-inline nb-create-article-category-title-op">
            <label class="form-control-label">Tiêu biểu:</label>
        </div>
        <div>

            <div class="form-check-inline mb-1">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input " name="highlight" value="0" {{ isset($aItem) ? (!$aItem->highlight ? "checked" : "") : "checked" }}>
                    <span class="bg-secondary nb-check text-white">Không</span>
                </label>
            </div>
            <div class="form-check-inline mb-1">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input " name="highlight" value="1" {{ isset($aItem) ? ($aItem->highlight ? "checked" : "") : "" }}>
                    <span class="bg-success text-white nb-check">Có</span>
                </label>
            </div>
        </div>

    </div>
    <div class="form-group d-flex">
        <div class="form-check-inline nb-create-article-category-title-op">
            <label class="form-control-label">Mới nhất:</label>
        </div>
        <div>

            <div class="form-check-inline mb-1">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input " name="lastest" value="0" {{ isset($aItem) ? (!$aItem->lastest ? "checked" : "") : "checked" }}>
                    <span class="bg-secondary nb-check text-white">Không</span>
                </label>
            </div>
            <div class="form-check-inline mb-1">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input " name="lastest" value="1" {{ isset($aItem) ? ($aItem->lastest ? "checked" : "") : "" }}>
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
                <button class="btn btn-primary text-decoration-none trans" type="button">Nội dung</button>
            </div>
        </div>
    </div>
</section>