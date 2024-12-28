<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'author', 'ISBN', 'genre', 'publication_date', 'availability_status'];

    public function borrowingRecords()
    {
        return $this->hasMany(BorrowingRecord::class, 'book_id');
    }

}
