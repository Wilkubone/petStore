@extends('layouts.app')

@section('content')
<h1>Edit Pet</h1>

<form action="/pets/{{ $pet['id'] }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $pet['name'] }}" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
            <option value="available" {{ $pet['status'] == 'available' ? 'selected' : '' }}>Available</option>
            <option value="pending" {{ $pet['status'] == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="sold" {{ $pet['status'] == 'sold' ? 'selected' : '' }}>Sold</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Pet</button>
</form>

<a href="/pets/{{ $pet['id'] }}">Back to Pet</a>
@endsection
