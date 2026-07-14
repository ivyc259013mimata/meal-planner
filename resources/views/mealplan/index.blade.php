@extends('layouts.app')

@section('title', '献立プランナー')

@section('content')

    @foreach ($mealPlans as $mealPlan)
        <div>
            <h2>{{ $mealPlan->day_of_week }}曜日</h2>

            @foreach ($mealPlan->recipes as $recipe)
                <p>{{ $recipe->name }}</p>
            @endforeach
        </div>
    @endforeach

@endsection