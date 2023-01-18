<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Cancion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CancionesController extends Controller
{

    private function tamaCanciones($cancion){
        $path = storage_path() . "/app/canciones/".$cancion;
        $size = filesize($path);
        return round($size / 1048576, 2);
    }

    private function obtenerPorcenDisponible() {
        $total=disk_total_space("/") / 1024 / 1024 / 1024;
        $libre=disk_free_space("/") / 1024 / 1024 / 1024;
       
        return number_format($total/$libre, 2);
    }


    public function subirCancion(Request $request)
    {
        //Sube la imagen
        $request->validate([
            'fileToUpload' => 'required|file|max:8024',
        ]);



        $fileName = request()->fileToUpload->getClientOriginalName();
        //$filePath = storage_path() . "/canciones/$fileName";

        if (!Storage::exists("/canciones/" . $fileName)) {  //si no está almacenada

            $request->fileToUpload->storeAs('canciones', $fileName);

            //inserta canción BD
            $cancion = new Cancion();
            $cancion->nombre = $fileName;
            $cancion->size = $this->tamaCanciones($fileName);
            $cancion->num = 0;
            $cancion->save();
            return back()->with('success', 'Tu canción se ha subido satisfactoriamente');
        }
        else {
            return back()->with('error', 'Tu canción ya está subida en el servidor');
        }

    }


    public function elegirCancion(Request $request)
    {

        $numCancion = request()->validate([
            'num1' => 'required',
            'num2' => 'required',
            'num3' => 'required',
            'num4' => 'required',
        ]);
        ///  dd($numCancion);

        Cancion::query()->update(['num' => 0]);

        if ($numCancion["num1"] != 0) {
            $num1 = Cancion::findOrFail($numCancion["num1"]);
            $num1->num = 1;
            $num1->save();
        }

        if ($numCancion["num2"] != 0) {

            $num2 = Cancion::findOrFail($numCancion["num2"]);
            $num2->num = 2;
            $num2->save();
        }
        if ($numCancion["num3"] != 0) {

            $num3 = Cancion::findOrFail($numCancion["num3"]);
            $num3->num = 3;
            $num3->save();
        }
        if ($numCancion["num4"] != 0) {

            $num4 = Cancion::findOrFail($numCancion["num4"]);
            $num4->num = 4;
            $num4->save();
        }
        return redirect()->route('horario');
    }

    private function obtenerEspacio() {
       
        return number_format(disk_free_space("/") / 1024 / 1024 / 1024, 2);
    }

    public function borrarCanciones()
    {
        $espacio=$this->obtenerEspacio();
        $porcenDispo= $this->obtenerPorcenDisponible();

        $canciones = Cancion::all();

        return view('borrarCanciones', compact('canciones','espacio','porcenDispo'));
    }


    public function eliminarCancion($id)
    {
        $ruta = storage_path() ."/app/canciones/";
        $dato = Cancion::findOrFail($id);
        $dato->delete();

        File::delete($ruta . $dato->nombre);

        return redirect()->route('horario');
    }

}
