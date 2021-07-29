<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'pub_date',
        'overview',
        'pages',
        'position'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}