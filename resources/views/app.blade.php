<!DOCTYPE html>
<html>
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Asana Dashboard</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">


    <!-- asana-dash stylesheet -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <!-- iScroll -->
    <script type="text/javascript" src="{{ asset('iscroll-master/build/iscroll.js') }}"></script>

    <script type="text/javascript" src="{{ asset('iscroll-master/build/myscroll.js') }}"></script>
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
    <!--chart js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.js"></script>
    <!--<script type="text/javascript" src="{{ asset('chart/dist/Chart.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('chart/dist/Chart.min.js') }}"></script> -->






</head>


<body>


    @yield('content')


</body>

<!--flipTimer.js  type="text/javascript" src="{ {asset('js/flipTimer.js')}}" -->
<script type="text/javascript">
    $(document).ready(function(){
        setInterval(function(){
            $(".flip-container").toggleClass("hover");
        }, 4000);
    });
</script>



</html>