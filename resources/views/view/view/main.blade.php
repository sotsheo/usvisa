<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/slick.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/plugin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/customer.css')}}">
    <script src="{{ asset('resources/assets/js/jquery-1.10.2.js')}}"></script>
    <script src="{{ asset('resources/assets/css/owl.carousel.min.js')}}"></script>
</head>
<body>

@include('view/view/base/header')
@yield('content')
@include('view/view/base/footer')

<script src="js/wow.min.js"></script>
<script type="text/javascript">
    new WOW().init();
</script>
<script type="text/javascript" src="{{ asset('resources/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('resources/assets/js/slick.min.js')}}"></script>
<script src="{{ asset('resources/assets/js/main_t.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".item h4").each(function(index){
            $(this).click(function(){
                $(this).find('i').toggleClass("fa-minus");
                $(this).next('.text').slideToggle();

            });
        });

        scroll_fix();
        $(window).scroll(function (event) {
            var scroll = $(window).scrollTop();
            scroll_fix();

        });
        function scroll_fix(){
            if($(window).scrollTop()>200){
                $(".header_content").addClass("fix_top");
                $(".menu_pc").addClass("fix_top");
            }
            else{
                $(".header_content").removeClass("fix_top");
                $(".menu_pc").removeClass("fix_top");
            }
        }
    });
</script>
</body>