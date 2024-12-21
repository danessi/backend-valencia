<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Mostrar formulario de creación de cliente
    public function create()
    {
        return view('clientes.create');
    }

    // Guardar el nuevo cliente
    public function store(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:20', // Validar el campo phone
        ]);

        // Crear el cliente
        Customer::create($validated);

        return redirect()->route('clientes.index');
    }

    // Listar todos los clientes
    public function index()
    {
        $clientes = Customer::all();
        return view('clientes.index', compact('clientes'));
    }

    public function destroy($id)
    {
        // Buscar el cliente por ID
        $cliente = Customer::findOrFail($id);

        // Eliminar el cliente
        $cliente->delete();

        // Redirigir a la lista de clientes con un mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }

    public function edit($id)
    {
        // Buscar el cliente por ID
        $customer = Customer::findOrFail($id);

        // Retornar la vista con los datos del cliente
        return view('clientes.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:customers,email,' . $id, // Ignorar el email actual
            'phone' => 'required|string|max:20',
        ]);
    
        // Buscar y actualizar el cliente
        $cliente = Customer::findOrFail($id);
        $cliente->update($validated);
    
        // Redirigir con mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }
}