@extends('app')

@section('content')



    @foreach($masterArray as $masterKey => $workspace)


        @if(array_key_exists('totalTasks', $workspace) or isset($workspace['totalTasks']))

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
                        <img class="imghead1" src="{{URL::asset('images/asana-dash.png')}}">
                    </div>

                    <div class="col-lg-4 col-xs-12 col-sm-12 col-md-4 imghead2">
                        <img class="imghead2"  src="{{URL::asset('images/logo.png')}}">
                    </div>


                    <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                        <div class="title text-center">
                            <h2 class="stats">Uncompleted Tasks {{$workspace['totalTasks']}}</h2>
                            <input type="hidden" id="userCount" value="{{$workspace['userCount']}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                <!-- users -->

                @if(array_key_exists('users',$workspace) or isset($workspace['users']))
                    <ul class="bxslider"><li>
                            {{-- */$userCount = 0; /* --}}
                    @foreach($workspace['users'] as $userIndex => $users)

                                <!-- setting userCount variable -->
                                {{-- */$userCount++; /* --}}

                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 card">

                            <div id="{{$userIndex}}" class="flip-container">
                                <div  class="flipper">



                                    @if(array_key_exists('tasks',$users) or isset($users['tasks']))

                                    <div class="front">

                                        <!-- front content -->
                                        <h2>{{$users['name']}}

                                        @if(isset($users['photo']))
                                        <img alt="User Photo" src="{{$users['photo']}}"/>
                                        @endif</h2>

                                            @foreach($users['tasks'] as $taskKey => $tasks)
                                                <div class="task">{{$tasks['name']}}</div>
                                            @endforeach

                                    </div>


                                    <div class="back">

                                        @if(isset($users['id']))


                                        <h2 id="name-{{$users['id']}}">{{$users['name']}}
                                            @if(isset($users['photo']))
                                                <img alt="User Photo" src="{{$users['photo']}}"/>
                                            @endif</h2>
                                            <input type="hidden" id="{{$users['taskCount']}}" value="{{$users['taskCount']}}">
                                            <input type="hidden" id="{{$workspace['totalTasks']}}" value="{{$workspace['totalTasks']}}">

                                                <p>{{$users['percent']}}%<br>
                                            {{$users['taskCount']}}</p>

                                            <div class="chart">

                                                <canvas id="{{$users['id']}}" width="25" height="25"></canvas>

                                            </div>

                                                <script type="text/javascript">
                                                jQuery(function() {
                                                        function percentChart() {

                                                        // var id =  $('[id^=name-').each(function(key, value) { var id = value.val() });

                                                        var id = $("#name-{{$users['id']}}").html();
                                                        var totalTasks = $("#{{$workspace['totalTasks']}}").val();
                                                        var taskCount = $("#{{$users['taskCount']}}").val();
                                                        console.log(id);

                                                        var ctx = document.getElementById("{{$users['id']}}").getContext("2d");
                                                        //var ctx = canvas.getContext("2d");
                                                        var myChart = new Chart(ctx, {
                                                        type: 'pie',
                                                        data: {
                                                        labels: [
                                                        "Users Tasks",
                                                        "Total Tasks"
                                                        //totalTasks
                                                        ],
                                                        datasets: [
                                                    {
                                                        data: [taskCount,totalTasks],
                                                        backgroundColor: [
                                                        "#FF6384",
                                                        "#36A2EB"
                                                        ],
                                                        hoverBackgroundColor: [
                                                        "#FF6384",
                                                        "#FFCE56"
                                                        ]
                                                    }]
                                                    }
                                                    });
                                                        //return this;
                                                    }

                                                    percentChart();
                                                });
                                                </script>

                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                                @if(($userCount % 8) == 0 )
                                </li><li>
                                @endif

                    @endforeach
                    </ul> </div>
            </div>
                @endif
        @endif
    @endforeach
@endsection
