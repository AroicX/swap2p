<?php

namespace App\Models;

use App\Models\Stage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merge extends Model
{
    use HasFactory;
    protected $fillable = ['upline', 'downline', 'position', 'status', 'stage'];

    public function getStage()
    {
        return $this->hasOne(Stage::class, 'sid', 'stage');
    }
    public function getUpline()
    {
        return $this->hasOne(User::class, 'user_id', 'upline');
    }
    public function getDownline()
    {
        return $this->hasOne(User::class, 'user_id', 'downline');
    }
}
