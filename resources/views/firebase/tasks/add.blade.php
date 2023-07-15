
<a href="{{url('firebaseTest')}}">Back</a>

<br>

<form action="{{ url('addTest') }}" method="POST">
    @csrf
    
    Add Task: <input name="task" type="text">

    <button type="submit">Add</button>
</form>
