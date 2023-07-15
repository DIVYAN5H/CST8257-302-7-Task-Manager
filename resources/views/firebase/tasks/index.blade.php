@extends('firebase.app')

@section('content')
<a href="{{ url('addTest') }}">Add</a>
<a href="delTest">Delete</a>
<a href="updateTest">Update</a>
<div>
    Data<br>
    @if(session('status')){
    <h2>{{session('status')}}</h2>
    }
    @else{
        <br>no session
    }
    @endif
</div>
@endsection