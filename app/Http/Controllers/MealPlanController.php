<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use App\Models\Recipe;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    public function generate()
    {
        // 既存の献立プランを全部消す（前回と同じ、重複防止のため）
        $oldMealPlans = MealPlan::all();
        foreach ($oldMealPlans as $oldMealPlan) {
            $oldMealPlan->recipes()->detach();
            $oldMealPlan->delete();
        }

        $days = ['月','火','水','木','金','土','日'];

        foreach ($days as $day) {
            $mealPlan = MealPlan::create([
                'day_of_week' => $day,
            ]);

            // その日のジャンルを、和食・洋食からランダムに1つ決める
            $genre = collect(['和食', '洋食'])->random();

            // 決まったジャンルの中から、主菜を1つランダムに選ぶ
            $main = Recipe::where('category', $genre)->where('dish_type', '主菜')->inRandomOrder()->first();

            // 同じジャンルの中から、副菜を1つランダムに選ぶ
            $side = Recipe::where('category', $genre)->where('dish_type', '副菜')->inRandomOrder()->first();

            // 見つかったものだけ、献立プランに紐づける
            if ($main) {
                $mealPlan->recipes()->attach($main->id);
            }
            if ($side) {
                $mealPlan->recipes()->attach($side->id);
            }
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
