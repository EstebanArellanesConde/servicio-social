<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $table = 'carrera';

    public function division()
    {
        return $this->hasOne(Division::class, 'id', 'division_id');
    }

}
