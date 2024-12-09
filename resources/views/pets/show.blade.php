@extends('layouts.app')

@section('content')
<h1>{{ $pet['name'] }}</h1>
<p>{{ $pet['status'] }}</p>
<a href="/pets/{{ $pet['id'] }}/edit">Edit</a>
<form action="/pets/{{ $pet['id'] }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>
<a href="/pets">Back to List</a>
@endsection
