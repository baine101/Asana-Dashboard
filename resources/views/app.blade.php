<!DOCTYPE html>
<html>
<head>
    <title>Asana Dashboard</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">


    <!-- asana-dash stylesheet -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">

</head>
<body>


<div class="container-fluid">

    @yield('content')
    </div>

@yield('footer')

</body>
</html>