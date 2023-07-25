
<a href="{{url('firebaseTest')}}">Back</a>

<br>

<form action="{{ url('registerTest') }}" method="POST">
    @csrf
    
    username: <input name="username" type="text">
    <br />
    email: <input name="email" type="email">
    <br>
    name: <input name="name" type="text">
    <br />
    password: <input name="password" type="password">


    <button type="submit">Register</button>
</form>