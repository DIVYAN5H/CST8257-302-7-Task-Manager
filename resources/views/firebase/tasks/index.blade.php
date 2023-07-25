@extends('firebase.app')

@section('content')
<a href="{{ url('addTest') }}">Add</a>
<div>
    Data
    <br>
    ----------
    <br />
    {{var_dump($userData)}}
    <br>
    ---------
    <br>

    <h2>
        user is {{$userData['user']['username']}}
    </h2>

    @if(isset($userData['userTasks']))
    @foreach($userData['userTasks'] as $userIdentifier => $userTasks)
        <h3>{{ $userIdentifier }}</h3>
        <ul>
            @foreach($userTasks as $taskId => $taskData)
                <li>Task: {{ $taskData['task'] }} - Priority: {{ $taskData['priority'] }}</li>
            @endforeach
        </ul>
    @endforeach
@endif


</div>
@endsection