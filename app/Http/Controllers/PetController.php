<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    // Ustalamy klucz API w nagłówkach
    private $apiKey;

    public function __construct()
    {
        // Ładujemy klucz API z pliku .env
        $this->apiKey = env('PETSTORE_API_KEY', 'special-key');
    }

    public function index()
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])->get('https://petstore.swagger.io/v2/pet/findByStatus?status=available');

        $pets = $response->json();


        // Jeśli API zwraca pojedynczy obiekt
        if (isset($pets['id'])) {
            $pets = [$pets];
        }

        // Jeśli brak wyników
        if (empty($pets)) {
            return view('pets.index', ['pets' => []])->with('status', 'No pets available.');
        }

        return view('pets.index', ['pets' => $pets]);
    }

    // Wyświetlanie formularza na dodanie nowego peta
    public function create()
    {
        return view('pets.create');
    }

    // Metoda do dodawania nowego zwierzęcia
    public function store(Request $request)
    {
        // Walidacja danych
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:available,pending,sold',
        ]);

        // Wysłanie danych do API, aby dodać zwierzę
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])->post('https://petstore.swagger.io/v2/pet', [
            'name' => $request->name,
            'status' => $request->status,
        ]);

        if ($response->successful()) {
            return redirect('/pets')->with('status', 'Pet added successfully!');
        } else {
            dd($response->status(), $response->body());
        }
    }

    // Metoda do wyświetlania szczegółów zwierzęcia
    public function show($id)
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])->get("https://petstore.swagger.io/v2/pet/{$id}");

        $pet = $response->json();

        // Walidacja danych z API
        if (!isset($pet['id'], $pet['name'], $pet['status'])) {
            return view('pets.show', [
                'pet' => [
                    'name' => 'Unknown Name',
                    'status' => 'Unknown Status',
                    'id' => null,
                ],
                'error' => 'Pet details are incomplete. Please check the API response.',
            ]);
        }

        return view('pets.show', ['pet' => $pet]);
    }

    // Metoda do edycji zwierzęcia
public function edit($id)
{
    $response = Http::withHeaders([
        'x-api-key' => $this->apiKey,
    ])->get("https://petstore.swagger.io/v2/pet/{$id}");

    $pet = $response->json();

    if (!$pet) {
        return redirect('/pets')->with('status', 'Pet not found.');
    }

    return view('pets.edit', ['pet' => $pet]);
}

// Metoda do aktualizacji zwierzęcia
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'status' => 'required|string|in:available,pending,sold',
    ]);

    $response = Http::withHeaders([
        'x-api-key' => $this->apiKey,
    ])->put("https://petstore.swagger.io/v2/pet", [
        'id' => $id,
        'name' => $request->name,
        'status' => $request->status,
    ]);

    if ($response->successful()) {
        return redirect("/pets/{$id}")->with('status', 'Pet updated!');
    }

    return back()->with('status', 'Failed to update pet.');
}

    // Metoda do usuwania zwierzęcia
    public function destroy($id)
    {
        Http::withHeaders([
            'x-api-key' => $this->apiKey  // Dodanie klucza API do nagłówka
        ])->delete("https://petstore.swagger.io/v2/pet/{$id}");

        return redirect('/pets')->with('status', 'Pet deleted!');
    }
}
