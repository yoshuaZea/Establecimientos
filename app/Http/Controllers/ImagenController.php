<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use App\Models\Establecimiento;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller{


    // UPLOAD FILE WITH DROPZONE
    public function upload(Request $request){
        // Leer imagen
        $route_img = $request->file('file')->store('establecimientos', 'public');

        // Resize a la imagen
        $image = Image::make(public_path("storage/{$route_img}"))->fit(800, 450);
        $image->save();

        // Almacenar con modelo
        $imageDB = new Imagen;
        $imageDB->id_establecimiento = $request->input('uuid');
        $imageDB->ruta_img = $route_img;
        $imageDB->save();

        // Respuesta al cliente
        $response = [
            'fileNameServer' => $route_img
        ];

        return response()->json($response, 200);
    }

    // REMOVE FILE
    public function destroy(Request $request){
        if($request->ajax()){

            $imageDelete = $request->get('imageDelete');

            // Cachar el uuid para consultar el establecimiento y pertenezca al usuario creado
            $uuid = $request->get('uuid');
            $establecimiento = Establecimiento::where('uuid', $uuid)->first();

            // Ejecutar el policy
            $this->authorize('delete', $establecimiento);

            // Eliminar del storage
            if(File::exists('storage/' . $imageDelete)){
                File::delete('storage/' . $imageDelete);

                // Elimina imagen de la BD
                Imagen::where('ruta_img', $imageDelete)->delete();

                // Respuesta al cliente
                $response = [
                    'msg' => 'Imagen eliminada correctamente',
                    'image' => $imageDelete,
                    'uuid' =>  $uuid
                ];

                return response()->json($response, 200);
            }
        }
    }
}
