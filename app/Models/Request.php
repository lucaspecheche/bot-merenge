<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';

    protected $fillable = ['userId', 'dishId'];

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class,'id');
    }
}
