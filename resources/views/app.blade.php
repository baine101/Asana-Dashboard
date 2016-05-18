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
    <!-- Aasana js -->
    <script src="https://github.com/Asana/node-asana/releases/download/<LATEST_RELEASE>/asana-min.js"></script>



</head>


<body onload="setInterval(timer, 5000);">


    @yield('content')



@yield('footer')

</body>

<!--flipTimer.js  type="text/javascript" src="{ {asset('js/flipTimer.js')}}"-->

<script>

    function timer(){
       // var count;
       // window.setInterval(flip,1000);
        //count++;

       // return count;
    }

    function flip()
    {
        //document.querySelector("#myCard").classList.toggle("flipper")

       // ("flipper").toggleclass("flip");
  //      window.setInterval(timer,60000);


        alert("hello");
    }


</script>

</html>