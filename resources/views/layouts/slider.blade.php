<div class="main-slider">           
    <div class="owl-carousel-slider owl-carousel">
    @php
        $sliders=App\Models\Slider::where('IsActive',1)->get();
    @endphp
    @if($sliders->count() > 0)
        @foreach($sliders as $slider)
            <div class="item">
                <a href="{{$slider->Url}}"><img src="{!!asset($slider->Img)!!}" alt="{!!$slider->Name!!}"></a>
            </div>
        @endforeach
    @else
    <code>Chưa có hình Ảnh Slider</code>
    @endif
    </div>
</div>
