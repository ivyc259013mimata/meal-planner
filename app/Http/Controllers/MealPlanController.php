<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use App\Models\Recipe;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    public function generate()
    {
        $oldMealPlans= MealPlan::all();
        foreach ($oldMealPlans as $oldMealPlan) {
            $oldMealPlan->recipes()->detach();
            $oldMealPlan->delete();
        }

        $days = ['月','火','水','木','金','土','日'];

        foreach ($days as $day) {
            //その曜日の献立プランを１件作る
            $mealPlan = MealPlan::create([
                'day_of_week' => $day,
            ]);

            $randomRecipe = Recipe::inRandomOrder()->first();
            $mealPlan->recipes()->attach($randomRecipe->id);
        }
        return redirect('/mealplan');
    }

    public function shoppingList()
    {
        $mealPlans = MealPlan::with('recipes.ingredients')->get();

        $ingredients = $mealPlans->flatMap(function ($mealPlan) {
            return $mealPlan->recipes->flatMap(function ($recipe) {
                return $recipe->ingredients;
            });
        });

        $shoppingList = $ingredients->groupBy('name')->map(function ($group) {
            return [
                'id' => $group->first()->id,
                'count' => $group->count(),
                'is_checked' => $group->first()->is_checked,
            ];
        });

        return view('shoppinglist.index', compact('shoppingList'));
    }

    public function index()
    {
        $mealPlans = MealPlan::with('recipes')->get();

        return view('mealplan.index', compact('mealPlans'));
    }

    
}
