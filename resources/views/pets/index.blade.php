@extends('layouts.app')

@section('content')
<h1>Pets</h1>
<a href="/pets/create">Add Pet</a>
<ul>
    @foreach($pets as $pet)
    <li>{{ $pet['name'] }} - <a href="/pets/{{ $pet['id'] }}">View</a></li>
    @endforeach
</ul>
@endsection
