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

    // Metoda do pobierania dostępnych zwierząt
    public function index()
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey  // Dodanie klucza API do nagłówka
        ])->get('https://petstore.swagger.io/v2/pet/findByStatus?status=available');

        return view('pets.index', ['pets' => $response->json()]);
    }

    // Metoda do dodawania nowego zwierzęcia
    public function store(Request $request)
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey  // Dodanie klucza API do nagłówka
        ])->post('https://petstore.swagger.io/v2/pet', $request->all());

        return redirect('/pets')->with('status', 'Pet added!');
    }

    // Metoda do wyświetlania szczegółów zwierzęcia
    public function show($id)
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey  // Dodanie klucza API do nagłówka
        ])->get("https://petstore.swagger.io/v2/pet/{$id}");

        return view('pets.show', ['pet' => $response->json()]);
    }

    // Metoda do aktualizacji zwierzęcia
    public function update(Request $request, $id)
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey  // Dodanie klucza API do nagłówka
        ])->put("https://petstore.swagger.io/v2/pet", $request->all());

        return redirect('/pets')->with('status', 'Pet updated!');
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
