<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dni extends Model
{
    protected $table = 'dnis';
    protected $fillable = ['number', 'nombre', 'apellido', 'edad', 'estado_civil', 'fecha_nacimiento', 'genero', 'direccion'];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}