@extends('layouts.app')

@section('title', 'レシピ一覧')

@section('content')

    <form action="/recipe" method="get" class="search-form">
        <input type="text" name="search" placeholder="レシピ名で検索">
        <button type="submit">🔍</button>
    </form>

    <div class="category-tabs">
        <a href="/recipe" class="category-tab {{ request('category') == null && request('dish_type') == null ? 'is-active' : '' }}">すべて</a>
        <a href="/recipe?category=和食" class="category-tab {{ request('category') == '和食' ? 'is-active' : '' }}">和食</a>
        <a href="/recipe?category=洋食" class="category-tab {{ request('category') == '洋食' ? 'is-active' : '' }}">洋食</a>
        <a href="/recipe?dish_type=主菜" class="category-tab {{ request('dish_type') == '主菜' ? 'is-active' : '' }}">主菜</a>
        <a href="/recipe?dish_type=副菜" class="category-tab {{ request('dish_type') == '副菜' ? 'is-active' : '' }}">副菜</a>
    </div>

    <div class="recipe-list">
        @foreach ($recipes as $recipe)
            <div class="recipe-card">
                <span class="recipe-card__thumb">
                    <img src="{{ asset('images/curry.png') }}" alt="{{ $recipe->name }}">
                </span>

                <div class="recipe-card__info">
                    <p class="recipe-card__name">{{ $recipe->name }}</p>
                    <p class="recipe-card__meta">{{ $recipe->category }}・{{ $recipe->dish_type }}</p>
                </div>

                <a href="/recipe/{{ $recipe->id }}/edit" class="recipe-card__edit">編集</a>

                <form action="/recipe/{{ $recipe->id }}/delete" method="POST" class="recipe-card__delete-form">
                    @csrf
                    <button type="submit">削除</button>
                </form>
            </div>
        @endforeach
    </div>

@endsection