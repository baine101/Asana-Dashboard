@extends('app')

@section('content')


    @foreach($value as $masterKey => $workspace)

        <?php /*  dd($workspace)  */ ?>

        @if(array_key_exists('totalTasks', $workspace) or isset($workspace['totalTasks']))

            <div class="row">
                <div class="head logo">
                    <div class="col-lg-2">
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

                            <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                                <div class="flipper">


                                    <div class="front">


                                        <!-- if was here -->

                                        <!-- front content -->
                                        <h2>{{ $users['name'] }}</h2>


                                        @if(array_key_exists('tasks',$users) or isset($users['tasks']))

                                            @foreach($users['tasks'] as $taskKey => $tasks)


                                                <div class="task"> {{ $tasks['name'] }} </div>



                                            @endforeach
                                        @endif
                                    </div>


                                    <div class="back">
                                        <h2>{{ $users['name'] }}</h2>
                                        <h2>{{ $users['percent'] }}%</h2>
                                        <h2>{{ $users['taskCount'] }}</h2>

                                    </div>
                                </div>
                            </div>
                        </div>




                    @endforeach
                @endif
            </div>

        @endif
    @endforeach


@endsection