<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 danh-muc">
    <div class="collection-categories block">
        <h2 class="collection-categories-heading"><span class="fa fa-bars"></span>Danh mục sản phẩm</h2>
        <div class="collection-categories-content">
            <ul class="cc-list">
            @php
                $listCatLeft=App\Models\Category::select('id','Alias', 'Name')
                                                ->where([
                                                    ['IsActive','=',1],
                                                    ['Level','=',0],
                                                    ['Type','=',3]
                                                    ])
                                                ->orderBy('Idx')
                                                ->get();
            @endphp
            @if($listCatLeft->count() > 0)
                @foreach($listCatLeft as $listCatLeft)
                    @php
                        $listCatLeftChildren=App\Models\Category::select('id','Alias', 'Name')
                                                        ->where([
                                                            ['IsActive','=',1],
                                                            ['Level','=',1],
                                                            ['ParentID','=', $listCatLeft->id],
                                                            ['Type','=',3]
                                                            ])
                                                        ->orderBy('Idx')
                                                        ->get();
                    @endphp
                    @if($listCatLeftChildren->count() > 0)
                    <li>
                       <a href="javascript:void(0)">{!!$listCatLeft->Name!!}<span class="fa fa-caret-right"></span></a>
                        <ul class="cc-list-child">
                            @foreach($listCatLeftChildren as $listCatLeftChildren)
                            <li><a href="{!!getLinkById($listCatLeftChildren->id)!!}">{!!$listCatLeftChildren->Name!!}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                    <li><a href="{!!getLinkById($listCatLeft->id)!!}">{!!$listCatLeft->Name!!}</a></li>
                    @endif
                @endforeach
            @else
                <code>Danh mục sản phẩm đang cập nhật</code>
            @endif
            </ul>
        </div>
    </div>
    <div class="online_support block">
        <div class="box-heading">
            <h2>Hỗ trợ trực tuyến</h2>
        </div>
        <div class="block-content">
            <div class="sp_1">
                <p>Tư vấn bán hàng 1</p>
                <p> <span>{!!$company->Phone!!}</span></p>
            </div>
            <div class="sp_2">
                <p></p>
                <p> <span></span></p>
            </div>
            <div class="sp_mail">
                <p>Email liên hệ</p>
                <p><a href="mailto:{!!$company->Email!!}" target="_blank">{!!$company->Email!!}</a></p>
            </div>
        </div>
    </div>
    <div class="collection-categories block">
        <h2 class="collection-categories-heading"><span class="fa fa-newspaper-o" aria-hidden="true"></span>Bài viết nổi bật</h2>
        <div class="collection-categories-content col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: 1px #ccc solid;padding: 0;">
            <div class="article-list">
            @php
                $listArticleHots=App\Models\Article::select('id','Alias', 'Name','Img','CatId')
                                                ->where([
                                                    ['IsActive','=',1],
                                                    ['Ishot','=',1]
                                                    ])
                                                ->orderBy('id')
                                                ->limit(10)
                                                ->get();
            @endphp
            @if($listArticleHots->count() > 0)
                @foreach($listArticleHots as $listArticleHot)
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 article-hot">
                        <a href="{{getLinkById($listArticleHot->CatId)}}/{{$listArticleHot->Alias}}.html" title="{{$listArticleHot->Name}}"><img src="Upload/article/{{$listArticleHot->Img}}" class="img-responsive" alt="{{$listArticleHot->Name}}"></a>
                       <h3 class="name-article"><a href="{{getLinkById($listArticleHot->CatId)}}/{{$listArticleHot->Alias}}.html" title="{{$listArticleHot->Name}}">{!!$listArticleHot->Name!!}</a></h3>
                    </div>
                @endforeach
            @else
                <code>Bài viết nổi bật đang cập nhật</code>
            @endif
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="collection-categories block">
        <h2 class="collection-categories-heading"><span class="fa fa-newspaper-o" aria-hidden="true"></span>Sản phẩm nổi bật</h2>
        <div class="collection-categories-content col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: 1px #ccc solid;padding: 0;">
            <div class="article-list">
            @php
                $listProductHots=App\Models\Product::select('id','Alias', 'Name','Img','CatId')
                                                ->where([
                                                    ['IsActive','=',1],
                                                    ['Ishot','=',1]
                                                    ])
                                                ->orderBy('id')
                                                ->limit(10)
                                                ->get();
            @endphp
            @if($listProductHots->count() > 0)
                @foreach($listProductHots as $listProductHot)
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 article-hot">
                        <a href="{{getLinkById($listProductHot->CatId)}}/{{$listProductHot->Alias}}.html" title="{{$listProductHot->Name}}"><img src="Upload/product/{{$listProductHot->Img}}" class="img-responsive" alt="{{$listProductHot->Name}}"></a>
                       <h3 class="name-article"><a href="{{getLinkById($listProductHot->CatId)}}/{{$listProductHot->Alias}}.html" title="{{$listProductHot->Name}}">{!!$listProductHot->Name!!}</a></h3>
                    </div>
                @endforeach
            @else
                <code>Bài viết nổi bật đang cập nhật</code>
            @endif
            </div>
        </div>
    </div>        
</div>