@extends('layouts.master')
@section('slider')
    @include('layouts.slider')
@endsection
@section('content')
<div class="main-pc">
    <h2>Phương châm Motech</h2>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="img-pc">
                    <img src="{{ asset('images/icon-pc-1.png') }}" class="img-responsive" alt="Image">
                </div>
                <h3>Đồng hàng cùng phát triển</h3>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="img-pc">
                    <img src="{{ asset('images/icon-pc-2.png') }}" class="img-responsive" alt="Image">
                </div>
                <h3>Hợp tác minh bạch hiệu quả</h3>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="img-pc">
                    <img src="{{ asset('images/icon-pc-3.png') }}" class="img-responsive" alt="Image">
                </div>
                <h3>Chia sẽ lợi ích cao nhất</h3>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="img-pc">
                    <img src="{{ asset('images/icon-pc-4.png') }}" class="img-responsive" alt="Image">
                </div>
                <h3>Sự hài lòng của bạn là động lực phát triển của chúng tôi</h3>
            </div>
        </div>
    </div>
</div>
<div class="main-service">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <h2><i class="fa fa-map-marker" aria-hidden="true"></i> Dịch vụ của chúng tôi</h2>
        @php
            $getListDV=\App\Models\Category::where(['IsActive'=>1,'Alias'=>'dich-vu'])->first();
        @endphp
        @if ($getListDV)
            @php
                $getListDVChid=$getListDV->categorys()->where(['IsActive'=>1])->orderBy('Idx')->get();
            @endphp
            @if ($getListDVChid->count() > 0)
                @foreach ($getListDVChid as $element)
                    <div class="item-service">
                        <div class="icon-service col-lg-2 col-md-2 col-xs-12 col-sm-12">
                            <img src="{{ asset(($element->Img=='')?'img/noimage.gif':$element->Img) }}" class="img-responsive" alt="{{$element->Name}}">
                        </div>
                        <div class="content-service col-lg-10 col-md-10 col-xs-12 col-sm-12">
                            <h3>{{$element->Name}}</h3>
                            <p>{{$element->Description}}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        @endif
    </div>
</div>

<div class="main-news">
    <h2><i class="fa fa-newspaper-o" aria-hidden="true"></i> TIN TỨC VÀ SỰ KIỆN</h2>
    <div class="clearfix"></div>
    @php
        $news=App\Models\Article::where('IsActive',1)->orderBy('created_at','desc')->limit(5)->get();
        $checkIdx=0;
    @endphp
    <div class="container">
        <div class="row">
            @if ($news->count() > 0)
                @foreach ($news as $new)
                    @if ($checkIdx==0)
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <div class="news" style="background:url('{{ asset($new->Img) }}') center;">
                                <div class="name-news">
                                    <a href="{{getLinkById($new->CatId)}}/{{$new->Alias}}.html" title="{{$new->Name}}"><h3>{{$new->Name}}</h3></a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="news" style="background-image:url('{{ asset($new->Img) }}');">
                                <div class="name-news">
                                    <a href="{{getLinkById($new->CatId)}}/{{$new->Alias}}.html" title="{{$new->Name}}"><h3>{{$new->Name}}</h3></a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @php
                        $checkIdx++;
                    @endphp
                @endforeach
            @endif
        </div>
    </div>
</div>
<div class="main-partner">
    <div class="container">
        <div class="row">
            <h2>Trở thành đối tác</h2>
            <a class="btn btn-default res-partner" href="{{ route('getLoginPartner') }}" role="button">Trở thành đối tác</a>
        </div>
    </div>
</div>
@endsection
@section('jsProduct')
@endsection
