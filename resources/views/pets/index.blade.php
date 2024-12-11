@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Available Pets</h1>

    <a href="{{ route('pets.create') }}" class="btn btn-primary mb-3">Add New Pet</a>

    <div class="row">
        @foreach($pets as $pet)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200?text=Pet+Image" class="card-img-top" alt="Pet Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $pet['name'] ?? 'No name available' }}</h5>
                        <p class="card-text">
                            <strong>Status:</strong> {{ ucfirst($pet['status'] ?? 'Unknown') }}
                        </p>
                        <a href="{{ route('pets.show', ['id' => $pet['id']]) }}" class="btn btn-info">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

