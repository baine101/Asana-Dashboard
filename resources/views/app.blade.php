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

    <!-- bxslider js -->
    <script type="text/javascript" src="{{asset('bxslider/jquery.bxslider.min.js')}}"></script>
    <!-- bxslider css -->
    <link rel="stylesheet" href="{{asset('bxslider/jquery.bxslider.css')}}">


    <script>
        $(window).ready(function () {
                $('.bxslider').bxSlider({
                    responsive: true,
                    infiniteLoop:true,
                    auto:true,
                    pause:4000,
                    autoStart:true
                });
        });
    </script>

</head>

<body>


    @yield('content')


</body>
<script type="text/javascript">
    //slider script

</script>


<script type="text/javascript">

    var userCount = $("#userCount").value;
    var x;
    setTimeout(function(){
    var elem = document.getElementsByClassName("flip-container");
       console.log(elem);
    }, 3000);












    $(document).ready(function(){
        setInterval(function(){
            $(".flip-container").toggleClass("hover");
        }, 10000);
    });
</script>

</html>