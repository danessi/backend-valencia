<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredientes = Ingredient::all();  // Obtiene todos los ingredientes
        return view('ingredientes.index', compact('ingredientes'));
    }

    public function create()
    {
        return view('ingredientes.create');  // Vista para crear ingrediente
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Ingredient::create($validated);  // Crea un nuevo ingrediente
        return redirect()->route('ingredientes.index');
    }

    public function edit(Ingredient $ingredient)
    {
        return view('ingredientes.edit', compact('ingredient'));  // Vista para editar ingrediente
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $ingredient->update($validated);  // Actualiza ingrediente
        return redirect()->route('ingredientes.index');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();  // Elimina ingrediente
        return redirect()->route('ingredientes.index');
    }
}
