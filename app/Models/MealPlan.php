<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    protected $fillable = [
        'day_of_week',
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'meal_plan_recipe');
    }
}
