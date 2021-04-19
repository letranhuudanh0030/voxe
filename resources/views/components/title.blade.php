<section id="element_title">
    <div class="row">
        <div class=" @isset($class) {{ $class }} @endisset">
            <div class="title @isset($classBlock) {{ $classBlock }} @endisset">
                <h3>
                    <span>
                        {{ $title }}
                    </span>
                </h3>
                @isset($teaser)
                    <p class="text-center">
                        {{ $teaser }}
                    </p>
                @endisset
            </div>
        </div>
    </div>
</section>