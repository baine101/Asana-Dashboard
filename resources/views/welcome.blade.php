@extends('app')

@section('content')
    
    @foreach($value as $masterKey => $workspace)

        <div class="content">
            <div class="title text-center"><h1>Asana Dashboard - {{ $workspace['name'] }} </h1></div>
        </div>
        <div class="row">

            @if(!array_key_exists('users', $workspace) && !isset($workspace['users']))
                <p>sorry no users exists</p>
            @else
                <div class="col-lg-1  col-lg-offset-1">
                @foreach($workspace['users'] as $userIndex => $users)

                    @if(!array_key_exists('name', $users) && !isset($users['name']))
                        <p>sorry no users set</p>
                    @endif


                        <h2>{{ $users['name'] }}</h2>
                        @if(!array_key_exists('tasks', $users) && !isset($users['tasks']))
                            <p>sorry no task exists</p>
                        @else

                            @foreach($users['tasks'] as $taskKey => $task)
                                @if(!array_key_exists('name', $task) && !isset($task['name']))

                                @else
                                    <p>{{ $task['name'] }}</p>
                                @endif

                            @endforeach

                        @endif
                    </div>

                @endforeach

            @endif
        </div>
    @endforeach

@endsection
