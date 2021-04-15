<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Establecimiento;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class EstablecimientoController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        try {
            $categorias = Categoria::all();

            return view('establecimientos.create', compact('categorias'));

        } catch (\Throwable $th) {
            return redirect('/oops')->with('msg', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $data = $request->validate([
            'nombre' => 'required|string',
            'categoria' => 'required|integer|exists:App\Models\Categoria,id',
            'imagen_principal' => 'required|image|max:1000',
            'direccion' => 'required|string',
            'colonia' => 'required|string',
            'lat' => 'required|string',
            'lng' => 'required|string',
            'telefono' => 'required|digits:10',
            'descripcion' => 'required|string|min:50',
            'apertura' => 'required|date_format:H:i',
            'cierre' => 'required|date_format:H:i|after:apertura',
            'uuid' => 'required|uuid'
        ]);

        try {
            // Guardar imagen
            $ruta_imagen = $request->file('imagen_principal')->store('principales', 'public');

            // Resize a la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 600);
            $img->save();

            // Guardar en BD
            $establecimiento = new Establecimiento($data);
            $establecimiento->categoria_id = $data['categoria'];
            $establecimiento->imagen_principal = $ruta_imagen;
            $establecimiento->user_id = auth()->user()->id;
            $establecimiento->save();
            
            return back()->with('msg', 'Establecimiento guardado exitosamente')->with('type', 'success');


        } catch (\Throwable $th) {
            $msg = $th->getMessage();
            return redirect()->route('oops')->with('msg', $msg);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Establecimiento $establecimiento){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Establecimiento $establecimiento){
        try {
            $categorias = Categoria::all();

            $establecimiento = auth()->user()->establecimiento;
            $establecimiento->apertura = date('H:i', strtotime($establecimiento->apertura));
            $establecimiento->cierre = date('H:i', strtotime($establecimiento->cierre));

            // Obtener imagenes adicionales
            $imagenes = Imagen::where('id_establecimiento', $establecimiento->uuid)->get();

            return view('establecimientos.edit', compact('categorias', 'establecimiento', 'imagenes'));

        } catch (\Throwable $th) {
            return redirect('/oops')->with('msg', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establecimiento $establecimiento){
        
        // Ejecutar policy
        $this->authorize('update', $establecimiento);

        $data = $request->validate([
            'nombre' => 'required|string',
            'categoria' => 'required|integer|exists:App\Models\Categoria,id',
            'imagen_principal' => 'nullable|image|max:1000',
            'direccion' => 'required|string',
            'colonia' => 'required|string',
            'lat' => 'required|string',
            'lng' => 'required|string',
            'telefono' => 'required|digits:10',
            'descripcion' => 'required|string|min:50',
            'apertura' => 'required|date_format:H:i',
            'cierre' => 'required|date_format:H:i|after:apertura',
        ]);

        try {
            // Guardar cambios en BD
            $establecimiento->nombre = $data['nombre'];
            $establecimiento->categoria_id = $data['categoria'];
            $establecimiento->direccion = $data['direccion'];
            $establecimiento->colonia = $data['colonia'];
            $establecimiento->lat = $data['lat'];
            $establecimiento->lng = $data['lng'];
            $establecimiento->telefono = $data['telefono'];
            $establecimiento->descripcion = $data['descripcion'];
            $establecimiento->apertura = $data['apertura'];
            $establecimiento->cierre = $data['cierre'];
            
            // Si usuario actualiza imagen
            if($request->imagen_principal){
                // Guardar imagen
                $ruta_imagen = $request->file('imagen_principal')->store('principales', 'public');
    
                // Resize a la imagen
                $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 600);
                $img->save();

                // Eliminar del storage la imagen anterior
                if(File::exists('storage/' . $establecimiento->imagen_principal)){
                    File::delete('storage/' . $establecimiento->imagen_principal);
                }

                // Nueva ruta para la img
                $establecimiento->imagen_principal = $ruta_imagen;
            }

            // Guardar cambios
            $establecimiento->save();
            
            return back()->with('msg', 'Cambios guardados exitosamente')->with('type', 'success');

        } catch (\Throwable $th) {
            $msg = $th->getMessage();
            return redirect()->route('oops')->with('msg', $msg);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establecimiento $establecimiento){
        //
    }
}
