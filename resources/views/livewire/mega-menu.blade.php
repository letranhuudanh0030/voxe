<div>
    <section id="mega-menu">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto">
                    <div class="border-mega-menu">
                        <div class="row">
                            <div class="col-3 pr-0">
                                <ul class="list-group py-2 pl-2 pr-0">
                                    @foreach ($productCate as $key => $cate)
                                        <li class="list-group-item {{ $activeClass }}" 
                                        wire:mouseover="$emit('showContent', {{ $cate->id }})"
                                        wire:mouseout="$emit('closeContent')"
                                        >{{ $key == 0 ? "Tất cả " : "" }}{{ $cate->name }}</li>                                        
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-9 py-4 " wire:mouseover="$emit('inContent')"
                            wire:mouseout="$emit('outContent')">                               
                                @livewire('mega-menu-content')                                      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
