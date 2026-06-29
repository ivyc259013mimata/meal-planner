<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [//$fillable：ユーザーの入力から、このカラムへの書き込みを許可します
        'name',
        'category',
        'is_favorite',
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredient');
    }
}
