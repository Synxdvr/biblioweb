<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'member_id';
    public $timestamps = true;

    protected $fillable = [
        'member_name',
        'contact_information',
        'address',
    ];

}