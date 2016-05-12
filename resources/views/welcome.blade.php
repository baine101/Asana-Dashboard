@extends('app')

@section('content')




    @foreach($value as $masterKey => $workspace)

        <div class="content">
            <div class="title text-center"><h1>Asana Dashboard - {{ $workspace['name'] }} </h1></div>
        </div>

            @if(!array_key_exists('users', $workspace) && !isset($workspace['users']))
                <p>sorry no users exists</p>
            @else

                <div id="wrapper">
                    <div id="scroller" class="scroller">

                        @foreach($workspace['users'] as $userIndex => $users)
                                <div class="collum">
                            @if(!array_key_exists('name', $users) && !isset($users['name']))
                                <p>sorry no users set</p>
                            @endif

                                   <?php $count = 0;  ?>
                                <h2>{{ $users['name'] }}</h2>
                                <hr>
                                @if(!array_key_exists('tasks', $users) && !isset($users['tasks']))
                                    <p>sorry no task exists</p>
                                @else
                                    <ul>
                                    @foreach($users['tasks'] as $taskKey => $task)
                                        @if(!array_key_exists('name', $task) && !isset($task['name']))

                                        @else

                                            <li>{{ $task['name'] }}</li>
                                            @if($count >= 10)

                                            @endif

                                        @endif

                                    @endforeach
                                        </ul>
                                @endif

                                </div>
                        @endforeach

                    </div>
                </div>

        @endif

    @endforeach

@endsection
