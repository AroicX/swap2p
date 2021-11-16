<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'message'];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }
}
