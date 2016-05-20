<!DOCTYPE html>
<html>
<head>
    <title>Asana Dashboard</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">


    <!-- asana-dash stylesheet -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <!-- iScroll -->
    <script type="text/javascript" src="{{ asset('iscroll-master/build/iscroll.js') }}"></script>

    <script type="text/javascript" src="{{ asset('iscroll-master/build/myscroll.js') }}"></script>
    <!-- jquery -->
    <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
    <!-- chartJs-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>


</head>


<body>


    @yield('content')



@yield('footer')

</body>

<!--flipTimer.js  type="text/javascript" src="{ {asset('js/flipTimer.js')}}" -->
<script>


    $(document).ready(function () {

            setInterval(function(){
                $(".flip-container").toggleClass("hover");
            }, 12 0000);

    });
</script>

</html>