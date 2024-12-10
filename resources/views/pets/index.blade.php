@extends('layouts.app')

@section('content')
<h1>Pets</h1>
<a href="/pets/create">Add Pet</a>
<ul>
    @forelse($pets as $pet)
        <li>
            {{ $pet['name'] ?? 'Unknown Name' }} -
            @if(isset($pet['id']))
                <a href="/pets/{{ $pet['id'] }}">View</a>
            @else
                No ID available
            @endif
        </li>
    @empty
        <p>No pets available.</p>
    @endforelse
</ul>
@endsection
