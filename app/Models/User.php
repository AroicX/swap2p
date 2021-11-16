<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\Payment;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function bank()
    {
        return $this->hasOne(Bank::class, 'id', 'bank_id');
    }
    public function merges()
    {
        return $this->hasMany(Merge::class, 'upline', 'user_id');
    }
    public function record()
    {
        return $this->hasOne(Record::class, 'user_id', 'user_id');
    }
    public function payment()
    {
        return $this->hasMany(Payment::class, 'upline_id', 'user_id');
    }
    public function payedTo()
    {
        return $this->hasMany(Payment::class, 'downline_id', 'user_id');
    }

    public function deleteAll()
    {
        //
        //     if ($this->merges()->delete()) {
        //         echo 'deleted merges';
        //     }
        //     if ($this->record()->delete()) {
        //         echo 'deleted record';
        //     }

        // delete all related photos
        $this->merges()->delete();
        $this->record()->delete();
        return parent::delete();
    }
    public function deleteMerges()
    {
        return $this->merges()->delete();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
