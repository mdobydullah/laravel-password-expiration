<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordSecurity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'password_expiry_days', 'password_updated_at'
    ];

    // set relation
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
