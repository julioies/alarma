<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';  //hacemos referencia a la tabla artículos
    protected $fillable = ['hora', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes'];

}
