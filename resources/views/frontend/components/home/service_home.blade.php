<section id="service_home">
    <div class="row service--bg">
        <div class="col-12 col-xl-11 mx-auto">
            <div class="service">
                <div class="row">
                    @if ($service_home)
                        @foreach ($service_home->article as $service)
                            <div class="col-12 col-lg-3 py-1">
                                <div class="row">
                                    <div class="col-4 service__image">
                                        <img src="{{ asset($service->avatar_image) }}" alt="{{ $service->title }}" class="img-fluid">
                                    </div>
                                    <div class="col-8 service__content align-self-center">
                                        <h3 class="service__content--title">{{ $service->title }}</h3>
                                        <div class="service__content--teaser">{!! $service->short_desc !!}</div>    
                                    </div>    
                                </div>                                
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>