<section id="form_contact">
    <div class="content-form">
        <form action="{{ route('send.mail') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group row">
                        <label for="" class="col-12 col-sm-3 col-form-label">@lang('text.first_name')</label>
                        <div class="col-12 col-sm-9">
                            <input type="text" class="form-control" name="firstname">
                            @error('firstname')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group row">
                        <label for="" class="col-12 col-sm-3 col-form-label">@lang('text.last_name')</label>
                        <div class="col-12 col-sm-9">
                            <input type="text" class="form-control" name="lastname">
                            @error('lastname')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group row">
                        <label for="" class="col-12 col-sm-3 col-form-label">@lang('text.phone')</label>
                        <div class="col-12 col-sm-9">
                            <input type="text" class="form-control" name="phone">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group row">
                        <label for="" class="col-12 col-sm-3 col-form-label">Email</label>
                        <div class="col-12 col-sm-9">
                            <input type="text" class="form-control" name="email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">@lang('text.subject')</label>
                <input type="text" class="form-control" name="subject">
            </div>
            <div class="form-group">
                <label for="">@lang('text.message')</label>
                <textarea id="" cols="20" rows="5" class="form-control" name="message"></textarea>
            </div>

            <div class="button-contact text-right mb-4">
                <button class="btn btn-danger px-4 py-2 text-uppercase" type="submit">
                    @lang('text.send_btn')
                </button>
            </div>
        </form>
    </div>
</section>