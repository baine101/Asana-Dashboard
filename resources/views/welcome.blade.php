@extends('app')

@section('content')


    <script type="text/javascript">

        function percentChart() {
            var name = $("#name").val();
            console.log(name);
            alert(name);

            var ctx = document.getElementById("percent").getContext("2d");
            //var ctx = canvas.getContext("2d");

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        name,
                        "Green"
                    ],
                    datasets: [
                        {
                            data: [300, 50],
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

            return this;
        }

    </script>

    @foreach($masterArray as $masterKey => $workspace)



        @if(array_key_exists('totalTasks', $workspace) or isset($workspace['totalTasks']))

            <div class="row">
                <div class="head logo">
                    <div class="col-lg-1">
                        <img class="imghead1" src="{{ URL::asset('images/asana-dash.png') }}">
                    </div>
                    <div class="col-lg-4 imghead2">
                        <img class="imghead2" src="{{ URL::asset('images/logo.png') }}">
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="title text-center">
                                <h1>Asana Dashboard | {{ $workspace['name'] }} | {{$workspace['totalTasks']}} </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <!-- users -->

                @if(array_key_exists('users',$workspace) or isset($workspace['users']))

                    @foreach($workspace['users'] as $userIndex => $users)

                        <div class="col-lg-3">

                            <div class="flip-container">
                                <div class="flipper">


                                    <div class="front">


                                        <!-- if was here -->

                                        <!-- front content -->
                                        <h2>{{ $users['name'] }}</h2>


                                        @if(array_key_exists('tasks',$users) or isset($users['tasks']))

                                            @foreach($users['tasks'] as $taskKey => $tasks)


                                                    <div class="task"> {{ $tasks['name'] }} </div>


                                            @endforeach

                                    </div>


                                    <div class="back">


                                        <h2 id="name">{{ $users['name'] }}</h2>
                                        <p>{{ $users['percent'] }}%<br>
                                        {{ $users['taskCount'] }}</p>
                                        @if(isset($users['id']))

                                        <canvas id="percent" width="10" height="10"></canvas>

                                            <script type="text/javascript">
                                                $(document).ready(percentChart());
                                            </script>

                                        @endif




                                    </div>
                                    @endif
                            </div>
                        </div>
                    </div>





                    @endforeach
                @endif
            </div>

        @endif
    @endforeach


@endsection