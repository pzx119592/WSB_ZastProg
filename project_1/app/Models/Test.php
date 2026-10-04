<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = ['name', 'surname', 'email', 'birthday', 'height'];

    protected function casts(): array
    {
        return ['birthday' => 'date', 'height' => 'decimal:2'];
    }
}
