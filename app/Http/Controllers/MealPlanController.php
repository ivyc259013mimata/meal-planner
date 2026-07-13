<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use App\Models\Recipe;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    public function generate()
    {
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
}
