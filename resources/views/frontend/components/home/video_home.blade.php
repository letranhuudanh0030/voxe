<section id="video_home">
    <x-title>
        <x-slot name='title'>Videos</x-slot>
        <x-slot name='class'>col-12 col-xl-11 mx-auto</x-slot>
    </x-title>
    <div class="row">
        <div class="col-12 col-xl-11 mx-auto">
            <div class="video">
                <div class="row">
                    @foreach ($videos as $video)
                        <div class="col-6 col-lg-4 p-2">
                            <div class="video__youtube" data-youtube>
                                <a data-fancybox href="https://www.youtube.com/watch?v={{ $video->link }}">
                                    <img src="https://i.ytimg.com/vi/{{ $video->link }}/sddefault.jpg" class="video__youtube--placeholder img-fluid" />
                                    <i class="fa fa-youtube-play video__youtube--button" aria-hidden="true" data-youtube-button="https://www.youtube.com/embed/{{ $video->link }}"></i>
                                </a>
                                {{-- <button class="video__youtube--button" data-youtube-button="https://www.youtube.com/embed/{{ $video->link }}"></button> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
