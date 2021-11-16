<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

    protected $fillable = [
        'user_id',
        'stage',
        'downline_brought',
        'downline_left',
    ];
}
