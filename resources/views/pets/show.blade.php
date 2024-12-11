@extends('layouts.app')

@section('content')
<h1>{{ $pet['name'] ?? 'Unknown Name' }}</h1>
<p>{{ $pet['status'] ?? 'Unknown Status' }}</p>

@if(isset($pet['id']))
    <a href="/pets/{{ $pet['id'] }}/edit">Edit</a>
    <form action="/pets/{{ $pet['id'] }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@else
    <p>Pet ID is missing. Unable to edit or delete this pet.</p>
@endif

<a href="/pets">Back to List</a>
@endsection
