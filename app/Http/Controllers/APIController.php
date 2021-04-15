<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Establecimiento;

class APIController extends Controller{

    // Método para obtener tódos los establecimientos
    public function index(){
        $establecimientos = Establecimiento::with('categoria')->get();

        return response()->json($establecimientos);
    }
    
    // Método para obtener categorías
    public function categorias(){
        $categorias = Categoria::all();

        return response()->json($categorias);
    }

    // Establecimientos por categoría
    public function categoria(Categoria $categoria){

        $establecimientos = Establecimiento::where('categoria_id', $categoria->id)
                                            ->with('categoria')
                                            ->take(3)
                                            ->latest()
                                            ->get();

        return response()->json($establecimientos);
    }

    // Establecimientos por categoría para mapa
    public function establecimientosCategoria(Categoria $categoria){

        $establecimientos = Establecimiento::where('categoria_id', $categoria->id)
                                            ->with('categoria')
                                            ->latest()
                                            ->get();

        return response()->json($establecimientos);
    }

    // Muestra un establecimiento en específico
    public function show(Establecimiento $establecimiento){

        $imagenes = Imagen::where('id_establecimiento', $establecimiento->uuid)->get();

        $establecimiento->imagenes = $imagenes;

        return response()->json($establecimiento);
    }
}
