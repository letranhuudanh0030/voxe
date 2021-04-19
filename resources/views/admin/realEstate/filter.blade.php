
<form action="{{ route('estate.filter') }}" method="GET" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="mt-2 card-body">   
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-3">
                            <label for="0">Tiều đề:</label>
                            <input type="text" class="form-control" name="title">
                        </div>  
                        <div class="col-3">
                            <label for="0">Loại hình:</label>
                            <select name="type_spec" class="form-control">
                                @foreach (config('variables.choose_form_estate') as $id => $item)
                                    <option value="{{ $id }}">{{ $item }}</option>
                                @endforeach
                            </select>   
                        </div>
                        <div class="col-3">
                            <label for="0">Giá:</label>
                            <select name="price_range" class="form-control">
                                @foreach (config('variables.price_range') as $id => $item)
                                    <option value="{{ $id }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="col-3">
                            <label for="0">Diện tích:</label>
                            <select name="acreage" class="form-control">
                                @foreach (config('variables.acreage') as $id => $item)
                                    <option value="{{ $id }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-3">
                            <label for="">Vùng miền:</label>
                            <select name="region_code" id="region" class="form-control">
                                @foreach (config('variables.region') as $key => $region)
                                    <option value="{{ $key }}">{{ $region }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="">Thành phố:</label>
                            <select name="city_code" id="city" class="form-control">
                                <option value="">-- Chọn thành phố --</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="">Quận/Huyện:</label>
                            <select name="district_code" id="district" class="form-control">
                                <option value="">-- Chọn quận/huyện --</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="0">Phường/Xã:</label>
                            <select name="ward_code" id="ward" class="form-control">
                                <option value="">-- Chọn phường/xã --</option>    
                            </select>   
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary" type="submit">
                Tiến hành lọc
            </button>
        </div>
    </div>
</form>
