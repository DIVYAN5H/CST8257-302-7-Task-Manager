
<a href="{{url('firebaseTest')}}">Back</a>

<br>

<form action="{{ url('loginTest') }}" method="POST">
    @csrf
    {{var_dump(session('status'))}}
    username: <input name="username" type="text">
    <br />
    password: <input name="password" type="password">


    <button type="submit">Login</button>
</form>