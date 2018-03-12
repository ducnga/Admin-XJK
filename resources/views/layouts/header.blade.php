<div class="header-top">

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                <ul class="company-info">

                    <li>{!!$company->Name!!}</li>

                    <li>MST: {{$company->Viber}} </li>

                </ul>   

            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3 no-padding">

                    <div class="dropdown">

                        <a id="dLabel" role="button" data-toggle="dropdown" class="" data-target="#" href="">

                          <i class="fa fa-sign-in" aria-hidden="true"></i>  Đăng nhập <i class="fa fa-angle-down" aria-hidden="true"></i>

                        </a>

                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                            <li><a href="{!!route('getLoginAccount')!!}" title="">Đăng nhập thành viên</a></li>

                            <li><a href="{!!route('getLoginPartner')!!}" title="">Đăng nhập đối tác</a></li>

                        </ul>

                    </div>

                </div>
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3 no-padding">

                    <div class="dropdown">

                        <a id="dLabel" role="button" data-toggle="dropdown" class="" data-target="#" href="">

                           <i class="fa fa-sign-out" aria-hidden="true"></i> Đăng ký <i class="fa fa-angle-down" aria-hidden="true"></i>

                        </a>

                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">

                            <li><a href="{!!route('getRegisterAccount')!!}" title="">Đăng ký thành viên</a></li>

                            <li><a href="{!!route('getRegisterPartner')!!}" title="">Đăng ký đối tác</a></li>

                        </ul>

                    </div>

                </div>
                <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3 no-padding">

                    <div class="dropdown">

                        <a id="dLabel" role="button" data-toggle="dropdown" class="" data-target="#" href="">

                           <i class="fa fa-user" aria-hidden="true"></i> Tài khoản <i class="fa fa-angle-down" aria-hidden="true"></i>

                        </a>

                        

                            @if (Auth::guard('partner')->check())
<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                <li><a href="{{ route('getPartnerMain') }}" title="">Tài khoản</a></li>

                                @php

                                    $countNotification=App\Models\Partner::Find(Auth::guard('partner')->id())->notification()->where('IsRead',0)->count();

                                @endphp

                                <li><a href="{{ route('getNotificationPartner') }}" title=""><i class="fa fa-bell" aria-hidden="true" style="color:red;"></i> {{$countNotification}} Thông báo mới</a></li>

                                <li><a href="{!!route('getLogoutPartner')!!}" title="">Đăng xuất</a></li>
</ul>
                            @elseif(Auth::guard('account')->check())
<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                <li><a href="{{ route('getAccount') }}" title="">Tài khoản</a></li>

                                <li><a href="{!!route('getLogout')!!}" title="">Đăng xuất</a></li>
</ul>
                            @endif

                        

                    </div>

                </div>

                

            </div>

        </div>

    </div>

</div>

<div class="header-content">

    <div class="container">

        <div class="row">

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

                <a href="" class="header-logo">

                    <img src="{{asset($company->Logo)}}" alt="{{$company->Name}}" title="{{$company->Name}}" style="padding-top: 15px;">

                </a>

            </div>

            <div class="col-md-6 col-md-6 col-sm-12 col-xs-12">

                <div class="banner_bottom_wrap">

                    <div class="banner_bottom">

                            <img src="{{ asset('images/all-icon.png') }}" class="img-responsive" alt="24 h">

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-3 hidden-xs hidden-sm">

                <div class="header-cart">

                    <div style="display:block;float: left;">

                        <img src="{{ asset('images/hotline1.jpg') }}" class="img-responsive" alt="hotline">

                    </div>

                    <div style="display:block;    float: left;">    

                        <span style="color: #000;font-weight: bold;margin-top: 3px;display: inline-block;">SỐ ĐIỆN THOẠI: </span><br>

                        <a href="tel:{{$company->Phone}}" style="color: #000;">{{$company->Phone}}</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

