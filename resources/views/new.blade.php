@extends('layouts.master')
@section('content')
<!-- Main Breadcrumb -->
<div class="main-content">
    <div class="main-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="">Trang chủ</a></li>
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
    <div class="container">
        <div class="row">
             <div class="col-md-9">
                <div class="article">
                    <h1 class="article-name">{!!$item->Name!!}</h1>
                    <div class="article-info">
                        <ul>
                        @php
                            $userName=App\Models\User::Find($item->CreateBy);
                        @endphp
                            <li>
                                <span class="fa fa-calendar"></span> {!!$item->created_at->format('d/m/Y')!!}
                            </li>
                            <li>
                                <span class="fa fa-edit"></span> {{$userName->FullName}}
                            </li>
                        </ul>
                    </div>
                    <div class="article-content rte">
                        {!!$item->Content!!}
                    </div>
                    <div class="entry-footer col-md-12">
                        <div class="single-share col-md-6 col-sm-6 col-xs-12">
                            <span>Chia sẻ bài viết</span>
                            <ul class="list-unstyled social">
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->full()}}" target="_blank" title="Facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/home?status={{url()->full()}}" title="Twitter" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://plus.google.com/share?url=https://plus.google.com/share?url={{url()->full()}}" title="Googleplus" target="_blank">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-3" style="padding: 0;">
                 <div class="blog-new">
                    <h2 class="blog-heading">DỊCH VỤ</h2>
                    <div class="blog-new-content">
                        <ul>
                        @php
                            $listDVNews=App\Models\Category::where(['IsActive'=>1,'Alias'=>'dich-vu','Type'=>3])->first();
                        @endphp
                        @if($listDVNews and $listDVNews->categorys()->where('IsActive',1)->count() > 0)
                            @foreach($listDVNews->categorys()->where('IsActive',1)->orderby('Idx')->get() as $listDVNew)
                            <li>
                                <h3 style="margin: 0;"><a class="bn-img" href="{!!getLinkById($listDVNew->id)!!}/" title="{!!$listDVNew->Name!!}">{!!$listDVNew->Name!!}
                                </a></h3>
                                <p class="description">{{$listDVNew->Description}}</p>
                            </li>
                            @endforeach
                        @else
                            <code>Bài viết đang cập nhật</code>
                        @endif
                        </ul>
                    </div>
                </div>
                <div class="blog-new">
                    <h2 class="blog-heading">Bài viết nổi bật</h2>
                    <div class="blog-new-content-hot">
                        <ul>
                        @php
                            $listArticleNews=App\Models\Article::where(['IsActive'=>1,'IsHot'=>1])->orderby('id')->limit(7)->get();
                        @endphp
                        @if($listArticleNews->count() > 0)
                            @foreach($listArticleNews as $listArticleNew)
                            <li>
                                <h3><a class="arti-hot" href="{!!getLinkById($listArticleNew->CatId)!!}/{!!$listArticleNew->Alias!!}.html" title=""><i class="fa fa-long-arrow-right" aria-hidden="true"></i> {!!$listArticleNew->Name!!}
                                </a></h3>
                            </li>
                            @endforeach
                        @else
                            <code>Bài viết đang cập nhật</code>
                        @endif
                        </ul>
                    </div>
                </div>
            </div>           
        </div>
    </div>
</div>
<!-- End Main Content -->
@endsection()