<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model {
    
    protected $fillable = [
        'nombre',
        'categoria_id',
        'imagen_principal',
        'direccion',
        'colonia',
        'lat',
        'lng',
        'telefono',
        'descripcion',
        'apertura',
        'cierre',
        'uuid',
        'user_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    // RELACIONES
    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function usuario(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
