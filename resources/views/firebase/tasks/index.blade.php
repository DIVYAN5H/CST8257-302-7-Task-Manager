@extends('firebase.app')

@section('content')
<a href="{{ url('addTest') }}">Add</a>
<a href="delTest">Delete</a>
<a href="updateTest">Update</a>
<div>
    Data<br />
    {{var_dump($fetchedData)}}
</div>
@endsection