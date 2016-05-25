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
    <link rel="stylesheet" href="{{asset('bxslider/jquery.bxslider.css')}}"/>

    <script>
        $(document).ready(function(){
            $('.bxslider2').bxSlider({
                onSliderLoad: function () {
                    setInterval(function(){
                        $(".bxslider2").toggleClass("bxslider3");
                    }, 9000);
                }
            });
        });
    </script>
</head>

<body>


    @yield('content')


</body>


<script type="text/javascript">
    $(document).ready(function(){
        setInterval(function(){
            $(".flip-container").toggleClass("hover");
        }, 4000);
    });
</script>

</html>