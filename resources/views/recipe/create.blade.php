@extends('layouts.app')

@section('title', 'レシピを登録')

@section('content')

<div class="form-card">
    <form action="/recipe/store" method="POST">
        @csrf
        <div>
            <label>レシピ名</label>
            <input type="text" name="name">
        </div>
        <div>
            <label>ジャンル</label>
            <select name="category">
                <option value="和食">和食</option>
                <option value="洋食">洋食</option>
            </select>
        </div>
        <div>
            <label>種類</label>
            <select name="dish_type">
                <option value="主菜">主菜</option>
                <option value="副菜">副菜</option>
            </select>
        </div>
        <div>
            <label>材料</label>
            <div class="ingredient-tags">
                @foreach ($ingredients as $ingredient)
                    <label class="ingredient-tag">
                        <input type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}" class="ingredient-tag__checkbox">
                        <span class="ingredient-tag__label">{{ $ingredient->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn-save">保存</button>
    </form>
</div>

@endsection