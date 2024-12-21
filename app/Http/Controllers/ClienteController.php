<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $clientes = Customer::all();  // Obtiene todos los clientes
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');  // Vista para crear cliente
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'nullable|string',
        ]);

        Customer::create($validated);  // Crea un nuevo cliente
        return redirect()->route('clientes.index');
    }

    public function edit(Customer $customer)
    {
        return view('clientes.edit', compact('customer'));  // Vista para editar cliente
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string',
        ]);

        $customer->update($validated);  // Actualiza cliente
        return redirect()->route('clientes.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();  // Elimina cliente
        return redirect()->route('clientes.index');
    }
}