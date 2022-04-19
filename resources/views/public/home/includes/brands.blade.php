<?php /** @var $brands \App\Models\Content\Content[]|\Illuminate\Support\Collection */ ?>
<?php /** @var $chunk \App\Models\Content\Content[]|\Illuminate\Support\Collection */ ?>
<?php /** @var $loop \App\Helpers\Dev\BladeLoopAutocompleteHelper */ ?>
@if(isset($brands) && $brands->isNotEmpty())
    @php
        $chunkNum = 4;
        $delays = [0, 100, 0, 100, 200, 300, 200, 300, 400, 500, 400, 500];
        $chunks = $brands->chunk($chunkNum);
    @endphp
    <section class="brands" id="brands">
        <div class="container">
            <h2 class="brands__title" data-aos="clip-top">Портфель брендов {!! editLinkAdmin(route('admin.brands.index')) !!}</h2>
            @foreach($chunks as $chunk)
                <div class="brands__block">
                    @foreach($chunk as $brand)
                        @php
                            $delay = $delays[ ($loop->parent->index * $chunkNum) + ($loop->iteration - 1) ] ?? current($delays);
                        @endphp
                        <div class="brands__block__img">
                            <img data-aos="clip-right"
                                 data-aos-delay="{{ $delay }}"
                                 src="{{ getPathToImage($brand->getImage()) }}" alt="{{ $brand->getName() }}">
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
@endif