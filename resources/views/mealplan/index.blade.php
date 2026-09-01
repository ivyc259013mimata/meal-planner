@extends('layouts.app')

@section('title', '献立プランナー')

@section('content')

    <a href="/mealplan/generate" class="btn-primary">
        ↻ 1週間分を自動生成する
    </a>

    <h2 class="section-label">今週の献立</h2>

    <div class="meal-list">
        @foreach ($mealPlans as $mealPlan)
            <div class="meal-card">
                <span class="meal-card__day">{{ $mealPlan->day_of_week }}</span>

                <div class="meal-card__dishes">
                    @foreach ($mealPlan->recipes->sortByDesc('dish_type') as $recipe)
                        <div class="meal-card__dish">
                            <span class="meal-card__thumb">
                                <img src="{{ asset('images/curry.png') }}" alt="{{ $recipe->name }}">
                            </span>
                            <span class="meal-card__name">{{ $recipe->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <a href="/shoppinglist" class="btn-outline">
        🛒 買い物リストを見る
    </a>

@endsection