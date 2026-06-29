<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        if($request->search != null) {
            $recipes = Recipe::where('name', 'like', '%' . $request->search . '%')->get();
        }else{
            $recipes = Recipe::all();
        }
        return view('recipe.index', compact('recipes'));
    }
}
