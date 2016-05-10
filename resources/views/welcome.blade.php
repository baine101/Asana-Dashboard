@extends('app')

@section('content')

@foreach($masterArray as $master)

        <!-- loop through workspace -->
@foreach($masterArray as $wsKey => $workspace)
    <div class="content">
        <div class="title text-center"><h1>Asana Dashboard - {{ $workspace['name'] }} </h1></div>
    </div>
    <div class="row">



        <!-- loop through username -->
        @foreach($masterArray as $userKey => $user)

            <div class="col-lg-1" style="background: repeating-linear-gradient(to left top, lightskyblue, lightgreen);">
                <h2>{{ $user['name'] }}</h2>

                <!-- loop through tasks-->
                @foreach($masterArray[$userKey] as $task)

                    <!-- if the task is not empty display task-->
                    @if(!empty($task['name']))
                        <p>{{$task['name']}}</p>
                        <hr>
                        @endif

                        <!-- End tasks foreach -->
                        @endforeach
            </div>
            <!-- End username foreach -->
            @endforeach
    </div>
    <!--End workspace foreach -->
    @endforeach
<!--End master foreach -->
@endforeach


@endsection
