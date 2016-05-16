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

<body>


    @yield('content')



@yield('footer')

</body>
</html>