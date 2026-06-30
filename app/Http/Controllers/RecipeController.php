<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index(Request $request)//一覧・検索
    {
        if($request->search != null) {
            $recipes = Recipe::where('name', 'like', '%' . $request->search . '%')->get();
        }else{
            $recipes = Recipe::all();
        }
        return view('recipe.index', compact('recipes'));
    }

    public function store(Request $request)//新規登録
    {
        Recipe::create([
            'name' => $request->name
        ]);

        session()->flash('message', 'レシピを保存しました');

        return redirect()->back();//連続登録
    }

    public function edit($id)//編集画面表示
    {
        $recipe = Recipe::find($id);
        return view('recipe.edit', compact('recipe'));
    }

    public function update(Request $request, $id)//更新
    {
        $recipe = Recipe::find($id);
        $recipe->name = $request->name;
        $recipe->category = $request->category;
        $recipe->save();

        return redirect('/recipe');
    }

    public function destroy($id)//削除
    {
        $recipe = Recipe::find($id);
        $recipe->delete();
        return redirect('/recipe');
    }
}
