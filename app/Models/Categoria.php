<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model{

    // Leer rutas por slug
    public function getRouteKeyName(){
        return 'slug';
    }

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    // RELACIONES
    public function establecimientos(){
        return $this->hasMany(Establecimiento::class, 'categoria_id');
    }
}
