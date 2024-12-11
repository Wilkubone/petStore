@extends('layouts.app')

@section('content')
<h1>Add New Pet</h1>

<form action="{{ route('pets.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
            <option value="available">Available</option>
            <option value="pending">Pending</option>
            <option value="sold">Sold</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Add Pet</button>
</form>

<a href="{{ route('pets.index') }}">Back to List</a>
@endsection
