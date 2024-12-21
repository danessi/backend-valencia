<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Método para la API
    public function index(Request $request)
    {
        // Obtener todos los pedidos
        $orders = Order::all();

        // Retornar la vista con los pedidos
        return view('orders.index', compact('orders'));
            
    }

    public function create()
    {
        $customers = Customer::all();
        $ingredients = Ingredient::all();
        return view('orders.create', compact('customers', 'ingredients'));
    }
    
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required',
            'ingredients' => 'required|array'
        ]);
    
        // Calcular el total basado en los ingredientes
        $total = 0;
        foreach ($request->ingredients as $ingredientId) {
            $ingredient = Ingredient::find($ingredientId);
            $total += $ingredient->price; // Sumar el precio de cada ingrediente
        }

        // Crear el pedido con el total calculado
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'status' => $request->status,
            'order_date' => now(),
            'total' => $total, // Guardar el total calculado
        ]);

    // Agregar los ingredientes al pedido (relación muchos a muchos)
    $order->ingredients()->attach($request->ingredients);
    
        return redirect()->route('orders.index')->with('success', 'Pedido creado correctamente.');
    }

    public function show(Order $order)
    {
        return $order; // Devuelve los detalles del pedido como JSON
    }

    // Método para las vistas Blade
    public function indexWeb()
    {
        $orders = Order::all(); // Obtenemos todos los pedidos
        return view('orders.index', compact('orders')); // Enviamos a la vista Blade
    }

    public function showWeb(Order $order)
    {
        return view('orders.show', compact('order')); // Vista del pedido específico
    }
}
