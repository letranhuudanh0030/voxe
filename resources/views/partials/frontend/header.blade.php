<section id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xl-11 mx-auto py-2">
                <div class="row">
                    <div class="col-12 col-lg-3 align-self-center text-center">
                        <img src="{{ asset($configGeneral->logo) }}" alt="Logo" class="img-fluid">
                    </div>
                    <div class="col-lg-6 align-self-center text-center slogan d-none d-sm-block">
                        <h1 class="slogan__company text-uppercase">{{ $configGeneral->name }}</h1>
                        <h3 class="slogan__sub text-capitalize">{{ $configGeneral->slogan }}</h3>
                    </div>
                    <div class="col-lg-3 align-self-center prices d-none d-lg-block">
                        <p class="prices__title">Tư vấn & báo giá</p>
                        @foreach (explode(',', $configGeneral->phone) as $phone)
                            <p class="prices__phone">{{ $phone }}</p>
                        @endforeach
                    </div>
                    {{-- <div class="col-lg-2 align-self-center action-header d-none d-lg-block">
                        <a href="" class="action-header__cart action-header__cart--icon ">
                            <b>{{ Cart::session(config('variables.sessionKey'))->getContent()->count() }}</b>
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>