<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;

class RecipeController extends Controller
{
    public function index(Request $request)//一覧・検索
    {
        $query = Recipe::query();

        if ($request->search != null) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->category != null) {
            $query->where('category', $request->category);
        }

        if ($request->dish_type != null) {
            $query->where('dish_type', $request->dish_type);
        }

        $recipes = $query->get();

        return view('recipe.index', compact('recipes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ingredients' => 'required',
            'name' => 'required',
            'category' => 'required',
            'dish_type' => 'required',
        ]);

        $recipe = Recipe::create([
            'name' => $request->name,
            'category' => $request->category,
            'dish_type' => $request->dish_type,
        ]);

        // 新規タグを、実際の材料として登録し直しつつ、idだけの配列を作る
        $ingredientIds = collect($request->ingredients)->map(function ($value) {
            if (str_starts_with($value, 'new:')) {
                // "new:"を取り除いて、材料名だけを取り出す
                $name = str_replace('new:', '', $value);
                // 同じ名前があればそれを使い、なければ新しく作る
                $ingredient = Ingredient::firstOrCreate(['name' => $name]);
                return $ingredient->id;
            }
            return $value;
        });

        $recipe->ingredients()->sync($ingredientIds);

        session()->flash('message', 'レシピを保存しました');

        return redirect()->back();
    }

    public function edit($id)//編集画面表示
    {
        $recipe = Recipe::find($id);// $idで指定されたレシピを1件取り出す
        $ingredients = Ingredient::all();// DBから全材料を取り出して
        return view('recipe.edit', compact('recipe', 'ingredients'));// edit画面にレシピと材料一覧を渡す
    }

    public function update(Request $request, $id)//更新
    {
        $recipe = Recipe::find($id);
        $recipe->name = $request->name;
        $recipe->category = $request->category;
        $recipe->dish_type = $request->dish_type;
        $recipe->save();

        // 新規タグを、実際の材料として登録し直しつつ、idだけの配列を作る
        $ingredientIds = collect($request->ingredients)->map(function ($value) {
            if (str_starts_with($value, 'new:')) {
                $name = str_replace('new:', '', $value);
                $ingredient = Ingredient::firstOrCreate(['name' => $name]);
                return $ingredient->id;
            }
            return $value;
        });

        $recipe->ingredients()->sync($ingredientIds);

        return redirect('/recipe');
    }

    public function destroy($id)//削除
    {
        $recipe = Recipe::find($id);
        $recipe->ingredients()->detach();
        $recipe->delete();
        return redirect('/recipe');
    }

    public function create()
    {
        $ingredients = Ingredient::all();// DBから全材料を取り出して
        return view('recipe.create', compact('ingredients'));// create画面に材料一覧を渡す
    }
}
