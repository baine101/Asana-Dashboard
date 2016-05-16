@extends('app')

@section('content')


    @foreach($value as $masterKey => $workspace)

        <?php  /*dd($value)*/ ?>

        @if($workspace['active'] == false)


        @else


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
                                <h1>Asana Dashboard | {{ $workspace['name'] }} </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(!array_key_exists('users', $workspace) or !isset($workspace['users']))

            @else

                    <div class="row">
                        <!-- users -->
                        @foreach($workspace['users'] as $userIndex => $users)


                            @if(!array_key_exists('tasks', $users) or !isset($users['tasks']))

                            @else




                                <div class="col-lg-3">

                                    <div class="flip-container " ontouchstart="this.classList.toggle('hover');">
                                        <div class="flipper">


                                            <div class="front">


                                                <!-- if was here -->

                                                <!-- front content -->
                                                <h2>{{ $users['name'] }}</h2>

                                                @foreach($users['tasks'] as $taskKey => $task)



                                                    @if(!array_key_exists('name', $task) or !isset($task['name']))


                                                    @else


                                                        <div class="task"> {{ $task['name'] }} </div>

                                                    @endif

                                                @endforeach

                                            </div>


                                            <div class="back">
                                                <h2>ello their</h2>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif


                    @endforeach
                    </div>





                    @endif

                    @endif

                    @endforeach


@endsection