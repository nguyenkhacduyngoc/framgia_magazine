<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Category extends Model
{
    protected $rules = [
        'name' => 'required|string|max:100',
        'description' => 'string',
    ];

    protected $fillable = [
        'name',
        'description',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    protected function validateCategory(array $data)
    {
        return Validator::make($data, $this->rules);
    }
}
