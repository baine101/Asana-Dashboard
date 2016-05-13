@extends('app')

@section('content')
    <div class="row">
        <div class="head logo">
            <div class="col-lg-2">
                <img class="imghead1" src="{{ URL::asset('images/asana-dash.png') }}">
            </div>


        @foreach($value as $masterKey => $workspace)

            <div class="col-lg-6">
                <div class="title text-center">
                    <h1>Asana Dashboard | {{ $workspace['name'] }} </h1>
                </div>
            </div>
            <div class="col-lg-4">
                <img class="imghead2" src="{{ URL::asset('images/logo.png') }}">
            </div>
        </div>
    </div>

        @if(!array_key_exists('users', $workspace) && !isset($workspace['users']))

        @else

            <div id="wrapper">
                <div id="scroller" class="scroller">

                    <!-- users -->
                    @foreach($workspace['users'] as $userIndex => $users)

                        <div class="row">
                            <div class="col-lg-4">


                            @if(!array_key_exists('name', $users) && !isset($users['name']) && !isset($users['tasks']['name']))

                            @endif


                            <div class="nametile">

                                <h2>{{ $users['name'] }}</h2>
                                <ul>
                                @if(!array_key_exists('tasks', $users) && !isset($users['tasks']))
                            @else


                                        <?php $count = 1; ?>
                                    @foreach($users['tasks'] as $taskKey => $task)
                                        @if(!array_key_exists('name', $task) && !isset($task['name']))


                                        @else

                                                <li>
                                                    <div class="tile"> {{ $task['name'] }} </div>
                                                </li>

                                        @endif

                                    @endforeach
                                </ul></div></div></div>
                        @endif


                @endforeach

            </div>
            </div><br>

        @endif

    @endforeach

@endsection
