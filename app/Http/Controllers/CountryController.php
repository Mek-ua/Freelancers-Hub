<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
   
    public function index()
    {
        return Country::all(); 
    }

    public function store(Request $request)
    {
        return Country::create($request->only(['name', 'code'])); 
    }

    public function show(Country $country)
    {
        return $country; 
    }

    public function update(Request $request, Country $country)
    {
        $country->update($request->only(['name', 'code'])); 
        return $country;
    }
    public function destroy(Country $country)
    {
        $country->delete(); 
        return ['Delete Country.']; 
    }
}
