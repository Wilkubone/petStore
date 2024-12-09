<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    public function index()
    {
        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus?status=available');
        return view('pets.index', ['pets' => $response->json()]);
    }

    public function store(Request $request)
    {
        $response = Http::post('https://petstore.swagger.io/v2/pet', $request->all());
        return redirect('/pets')->with('status', 'Pet added!');
    }

    public function show($id)
    {
        $response = Http::get("https://petstore.swagger.io/v2/pet/{$id}");
        return view('pets.show', ['pet' => $response->json()]);
    }

    public function update(Request $request, $id)
    {
        $response = Http::put("https://petstore.swagger.io/v2/pet", $request->all());
        return redirect('/pets')->with('status', 'Pet updated!');
    }

    public function destroy($id)
    {
        Http::delete("https://petstore.swagger.io/v2/pet/{$id}");
        return redirect('/pets')->with('status', 'Pet deleted!');
    }
}
