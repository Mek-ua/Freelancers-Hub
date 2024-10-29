<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        return PaymentMethod::all(); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'api_address' => 'required|string|max:255',
            'token' => 'required|string',
            'user_id' => 'required|exists:users,id', // Assuming user_id should exist in users table
        ]);

        return PaymentMethod::create($request->only(['name', 'api_address', 'token', 'user_id']));
    }

    public function show(PaymentMethod $Payment_methods)
    {
        return $Payment_methods; 
    }

    public function update(Request $request, PaymentMethod $Payment_methods)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'api_address' => 'required|string|max:255',
            'token' => 'required|string',
        ]);

        $Payment_methods->update($request->only(['name', 'api_address', 'token']));
        return $Payment_methods;
    }

    public function destroy(PaymentMethod $Payment_methods)
    {
        $Payment_methods->delete(); 
        return [$Payment_methods];
    }
}
