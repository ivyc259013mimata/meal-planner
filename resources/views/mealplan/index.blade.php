<h1>献立プラン</h1>

@foreach ($mealPlans as $mealPlan)
    <div>
        <h2>{{ $mealPlan->day_of_week}}曜日</h2>

        @foreach ($mealPlan->recipes as $recipe)
            <p>{{ $recipe->name }}</p>
        @endforeach
    </div>
@endforeach