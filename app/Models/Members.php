<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Members extends Authenticatable
{
    use Notifiable;

    protected $table = 'members';
    protected $primaryKey = 'member_id';
    public $timestamps = true;

    protected $fillable = [
        'member_username',
        'member_fullname',
        'contact_information',
        'address',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}