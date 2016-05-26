<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Asana Dashboard</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">


    <!-- asana-dash stylesheet -->
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    <!-- iScroll -->
    <script type="text/javascript" src="{{asset('iscroll-master/build/iscroll.js')}}"></script>

    <script type="text/javascript" src="{{asset('iscroll-master/build/myscroll.js')}}"></script>

    <!-- jQuery library (served from Google) -->
    <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>

    <!--chart js-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.bundle.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.js"></script>

    <!-- bxSlider Javascript file -->
    <script type="text/javascript" src="{{asset('bxslider/jquery.bxslider.js')}}"></script>
    <!-- bxSlider CSS file -->
    <link rel="stylesheet" href="{{asset('css/bxslider.css')}}"/>

    <script>

        // get page width
        var pageWidth = $(window).width();

        $(window).ready(function () {
                $('.bxslider2').bxSlider({
                    slideWidth: pageWidth,
                    slideMargin: 2,
                    onSliderLoad: function () {
                        setInterval(function () {
                           //$(".bxslider2").toggleClass("bxslider3");
                        }, 7000);
                    }
                });
            });
    </script>
</head>

<body>


    @yield('content')


</body>
<script type="text/javascript">
    //slider script

//    $(document).ready(function(){
//        $('.your-class').slick({
//            $('.responsive').slick({
//            dots: true,
//            infinite: false,
//            speed: 300,
//            slidesToShow: 4,
//            slidesToScroll: 4,
//            responsive: [
//                {
//                    breakpoint: 1024,
//                    settings: {
//                        slidesToShow: 3,
//                        slidesToScroll: 3,
//                        infinite: true,
//                        dots: true
//                    }
//                },
//                {
//                    breakpoint: 600,
//                    settings: {
//                        slidesToShow: 2,
//                        slidesToScroll: 2
//                    }
//                },
//                {
//                    breakpoint: 480,
//                    settings: {
//                        slidesToShow: 1,
//                        slidesToScroll: 1
//                    }
//                }
//                // You can unslick at a given breakpoint now by adding:
//                // settings: "unslick"
//                // instead of a settings object
//            ]
//        });
//    });




//      // Get your list elements
//        var ul = document.getElementsByTagName('ul');
//
//
//        // loop through boxes
//        for (var x = 0; x < ul.length; x++) {
//
//            // set position based on loop iteration x pageWidth (first is 0, second will be -1200 etc)
//            var position = x * pageWidth;
//
//            // apply transition to current element
//            $(ul).toggleClass("bxslider3");
//
//            console.log(ul[x]);
//
//        };

</script>


<script type="text/javascript">
    $(document).ready(function(){
        setInterval(function(){
            $(".flip-container").toggleClass("hover");
        }, 4000);
    });
</script>

</html>