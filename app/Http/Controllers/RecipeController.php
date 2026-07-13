<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;

class RecipeController extends Controller
{
    public function index(Request $request)//一覧・検索
    {
        if($request->search != null) {
            $recipes = Recipe::where('name', 'like', '%' . $request->search . '%')->get();
        }else{
            $recipes = Recipe::all();//検索欄が空欄であれば全部表示
        }
        return view('recipe.index', compact('recipes'));
    }

    public function store(Request $request)//新規登録
    {
        $recipe =Recipe::create([
            'name' => $request->name,// フォームの「name」欄の値を、recipesテーブルのnameカラムに保存
            'category' => $request->category,// フォームの「category」欄の値を、recipesテーブルのcategoryカラムに保存
        ]);

        $recipe->ingredients()->sync($request->ingredients ?? []);// 選ばれた材料をrecipe_ingredientテーブルに保存する
        
        session()->flash('message', 'レシピを保存しました');

        return redirect()->back();//連続登録
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
        $recipe->save();

        $recipe->ingredients()->sync($request->ingredients);

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
