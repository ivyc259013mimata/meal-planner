<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();

        return view('ingredient.index', compact('ingredients'));
    }

    public function store(Request $request)
    {
        Ingredient::create([
            'name' => $request->name      
        ]);
        return redirect('/ingredient');
    }
}
