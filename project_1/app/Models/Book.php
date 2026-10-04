<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Osobna tabela zachowuje ćwiczenie z Fakerem z tematu 7.
    protected $table = 'books_temat9';

    protected $fillable = ['title', 'year', 'price', 'pages', 'publication_place'];

    protected function casts(): array
    {
        return ['year' => 'integer', 'price' => 'decimal:2', 'pages' => 'integer'];
    }
}
