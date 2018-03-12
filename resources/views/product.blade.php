@extends('layouts.master')
@section('content')
<div class="main-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="index.html">Trang chủ</a></li>
                    @if($check)
                    <li><a href="{!!getLinkById($check->id)!!}">{!!$check->Name!!}</a></li>
                    @endif
                    @if(isset($checkParent))
                    <li><a href="{!!getLinkById($checkParent->id)!!}">{!!$checkParent->Name!!}</a></li>
                    @endif
                    @if(isset($checkChild))
                    <li><a href="{!!getLinkById($checkChild->id)!!}">{!!$checkChild->Name!!}</a></li>
                    @endif
                    <li class="active">{!!$item->Name!!}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- End Main Breadcrumb -->
<!-- Main Content -->
<div class="main-content">
    <div class="container">
        <div class="row pd-top" itemscope itemtype="http://schema.org/Product">
            <meta itemprop="url" content="Uploads/product/{{$item->Img}}">
            <meta itemprop="image" content="Uploads/product/{{$item->Img}}">
            <meta itemprop="shop-currency" content="VND">
            <div class="col-md-6">
                <div class="product-image product-main-image">
                    <div class="slider-wrap">
                        <div class='pd_slide_thumb slick_thumb col-sm-2 noleftpadding hidden-xs'>
                        @php
                            $images=App\Models\Product::Find($item->id)->images()->get();
                        @endphp
                        @if($images->count() > 0)
                            @foreach($images as $image)
                            <div class="slick-slide" >
                                <div class="img">
                                    <img src="Upload/product/images/{!!$image->Img!!}" alt="{!!$item->Name!!}" title="{!!$item->Name!!}">
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="slick-slide" >
                                <div class="img">
                                    <img src="Upload/product/{!!$item->Img!!}" alt="{!!$item->Name!!}" title="{!!$item->Name!!}">
                                </div>
                            </div>
                        @endif
                        </div>
                        <div class="pd_slide col-sm-10 nopadding">
                            @if($images->count() > 0)
                                @foreach($images as $image)
                                <div class="slick-slide" >
                                    <div class="img">
                                        <img src="Upload/product/images/{!!$image->Img!!}" alt="{!!$item->Name!!}" title="{!!$item->Name!!}">
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="slick-slide" >
                                    <div class="img">
                                        <img src="Upload/product/{!!$item->Img!!}" alt="{!!$item->Name!!}" title="{!!$item->Name!!}">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>              
                </div><!-- Product Single - Gallery End -->
            </div>
            <div class="col-md-6">
                <h1 itemprop="name" class="pd-name">{!!$item->Name!!}</h1>
                <p class="pd-price price-box" itemprop="price">
                    @if($item->Sale>0)
                    <span class="sale">
                        <del>
                            {{($item->Price*$item->Sale)/100 + $item->Price}}₫
                        </del> -
                    </span>
                    @endif
                    <span class="special-price"><span class="price product-price">{{($item->Price > 0) ? number_format($item->Price).'₫':'Liên hệ'}}</span></span>
                </p>
                <p class="pd-description-mini">{!!strip_tags($item->ShortContent)!!}</p>
                <div class="pd-form">
                    <form action="{!!route('postAddItemCart')!!}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <input type="hidden" name="Price" value="{{$item->Price}}">
                        <label for="">Số lượng</label>
                        <input type="number" class="input-text qty" title="Số lượng" value="1" min="1" max="50"  name="Quantity" >
                        <div class="clearfix"></div>
                        <button type="submit">Mua hàng</button>
                    </form>
                </div>
                <div>
                    <span class="products-price">Mua giá sỉ liên hệ: </span><a class="products-price" href="tel:{!!$company->Phone!!}" title=" Liên hệ mua giá sỉ">{!!$company->Phone!!}</a>
                </div>
            </div>
        </div>
        <div class="row pd-bottom">
            <div class="col-md-9 col-sm-12">
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs pd-nav" role="tablist">
                        <li role="presentation" class="active"><a href="#pd-thong-tin" aria-controls="pd-thong-tin" role="tab" data-toggle="tab">Thông tin sản phẩm</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active rte" id="pd-thong-tin">
                            {!!$item->Content!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="pd-best-seller">
                    <div class="heading">
                        <h3>Có thể bạn quan tâm</h3>
                    </div>
                    <div class="block-content">
                        <ul>
                        @php
                            $ProductHot=App\Models\Product::select('id','Name','Alias','CatId','Img','Price','Sale','ShortContent')->where([['IsActive','=',1],['IsHot','=',1]])->orderBy('id','decs')->limit(5)->get();
                        @endphp
                        @if($ProductHot->count() > 0)
                            @foreach($ProductHot as $ProductHot)
                            <li class="item">
                                <div class="product_item_mini">
                                    <div class="col-md-4 col-sm-3 col-xs-3">
                                        <a href="{{getLinkById($ProductHot->CatId)}}/{{$ProductHot->Alias}}.html" title="{!!$ProductHot->Name!!}">
                                            <img src="Upload/product/{{$ProductHot->Img}}" class="img-reponsive" alt="{{$ProductHot->Name}}" title="{!!$ProductHot->Name!!}">
                                        </a>
                                    </div>
                                    <div class="col-md-8 col-sm-9 col-xs-9">
                                        <h3 class="pd-bs-name"><a href='{{getLinkById($ProductHot->CatId)}}/{{$ProductHot->Alias}}.html' title="{!!$ProductHot->Name!!}">{{$ProductHot->Name}}</a></h3>
                                        <p class="pd-bs-price price-box">
                                            @if($ProductHot->Sale>0)
                                            <span class="sale">
                                                <del>
                                                    {{($ProductHot->Price*$ProductHot->Sale)/100 + $ProductHot->Price}}₫
                                                </del> -
                                            </span>
                                            @endif
                                            <span class="special-price"><span class="price product-price">{{($ProductHot->Price > 0) ? $ProductHot->Price.'₫':'Liên hệ'}}</span></span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        @else
                            <code>Sản phẩm đang cập nhật!</code>
                        @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()
@section('jsProduct')
<link href="{!!asset('css/slick94a9.css')!!}" rel='stylesheet' type='text/css' />
<script src="{!!asset('js/master_script94a9.js')!!}" type='text/javascript'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.pd_slide').slick({
            prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
            asNavFor: '.pd_slide_thumb',
            responsive: [
            {
                breakpoint: 767,
                settings: {
                    prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
                    nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
                    asNavFor:null                                       
                }
            }
            ]
        })
        .on('afterChange', function(event, slick, currentSlide, nextSlide){
            $('.pd_slide_thumb .slick-slide').removeClass('slick-current');
            $('.pd_slide_thumb .slick-slide[data-slick-index="' + currentSlide + '"]').addClass('slick-current');
        });
        if($(window).width() > 767) {
            $('.pd_slide_thumb').slick({
                slidesToShow: 5,
                arrows: false,
                asNavFor: '.pd_slide',
                focusOnSelect: true,
                vertical: true,
            });
        }
    });
</script>
@endsection