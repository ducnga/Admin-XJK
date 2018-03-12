<!DOCTYPE html>

<html lang="vi" class="mostly-customized-scrollbar">

<head>

    <meta charset="UTF-8" />

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="content-language" content="vi" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <meta name="robots" content="@yield('robot', 'noodp,noindex,nofollow')"" />

    <meta name='revisit-after' content='1 days' />

    <base href="{{asset('')}}" >

    <link rel="icon" href="{{asset('trademarks/favicon.png')}}" type="image/x-icon" />

    <link rel="canonical" href="{{url()->full()}}" />

    @include('layouts.share')   

    <!-- CSS -->

    <link rel="alternate" type="application/rss+xml" title="Tiêu đề của trang RSS" href="{{url()->full()}}/rss/" />

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

    <link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet" />

    <link href="{{asset('css/owl.theme.default.min.css')}}" rel="stylesheet" />

    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />

    <link href="{{asset('css/style.css')}}?v=1.0.3" rel="stylesheet" />

    <link href="{{asset('css/menu.css')}}" rel="stylesheet" />

    <link href="{{asset('css/alert.css')}}" rel="stylesheet" />         

</head>

<body >

    <header class="header">

    @include('layouts.header')           

    </header>

    @include('layouts.menu')

    <!-- Main Slider -->

    @include('layouts.slider')

    @yield('content')       

    <!-- Footer -->      

    @include('layouts.footer')

</body>

    <script src="{{asset('js/jquery.min.js')}}"></script>

    <script src="{{asset('js/jquery-1.11.3.js')}}"></script>

    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <script src="{{ asset('js/toastr.js') }}"></script>

    <script src="{{asset('js/menu.js')}}"></script>

    <script type="text/javascript">

        $("#cssmenu").menumaker({

            title: "Menu",

            format: "multitoggle"

        });

    </script>

    <script>

    $(document).ready(function(){

       $('.owl-carousel-slider').owlCarousel({

            autoplay: true,

            autoplayTimeout: 5000,

            autoplayHoverPause: true,

            loop:false,

            nav: true,

            dots:false,

            navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>',

             '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],

            margin:15,

            responsive:{

                0:{

                    items:1

                },

                600:{

                    items:1

                },

                1000:{

                    items:1

                }

            }

        });

    })

    </script>

    <script src="{{asset('js/owl.carousel.min.1.js')}}"></script>

    @yield('jsProduct')

</html>