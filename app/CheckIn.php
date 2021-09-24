<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class CheckIn extends Model
{    protected $fillable = [
        'session', 'status', 'time','user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
