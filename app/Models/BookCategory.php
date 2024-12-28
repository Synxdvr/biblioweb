<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id'; // Ensure this is set correctly
    protected $fillable = [
        'category_name',
        'description',
    ];
}
