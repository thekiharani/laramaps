<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('order.create', [
            'orders' => Restaurant::all()
        ]);
    }

    public function create()
    {
        return view('order.create');
    }

    public function store(Request $request) {
        $order = Restaurant::create([
            'name' => $request->name,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);

        return redirect()->route('orders.index')->with('order', $order);
    }

    public function show(Restaurant $order)
    {
        return view('order.show', [
            'order' => $order
        ]);
    }
}
