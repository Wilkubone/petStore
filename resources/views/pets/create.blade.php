@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Dodaj nowe zwierzę</h1>
    <form action="{{ route('pets.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Imię" required>
        <select name="status">
            <option value="available">Dostępny</option>
            <option value="pending">Oczekujący</option>
            <option value="sold">Sprzedany</option>
        </select>
        <button type="submit">Dodaj</button>
    </form>
</div>
@endsection
