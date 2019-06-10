<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $table = 'dishes';

    public function users()
    {
        return $this->belongsToMany(User::class, 'requests', 'dishId', 'userId')->withTimestamps();
    }

    public function find(int $id)
    {
       return Dish::query()->find($id);
    }
}
