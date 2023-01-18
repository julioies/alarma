<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Cancion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psy\Readline\Hoa\Exception;
use Illuminate\Database\QueryException;


class HorariosController extends Controller
{

    private function obtenerEspacio() {
       
        return number_format(disk_free_space("/") / 1024 / 1024 / 1024, 2);
    }

    private function obtenerPorcenDisponible() {
        $total=disk_total_space("/") / 1024 / 1024 / 1024;
        $libre=disk_free_space("/") / 1024 / 1024 / 1024;
       
        return number_format($total/$libre, 2);
    }

   

    public function mostrar()
    {
        $canciones = Cancion::all();
        $horarios = Horario::orderBy('hora', 'asc')->get();
        $espacio=$this->obtenerEspacio();
        $porcenDispo= $this->obtenerPorcenDisponible();
       
        
        return view('insertar', compact('horarios', 'canciones','espacio','porcenDispo'));
    }


    public function nuevaFila(Request $request)
    {

        $datos = request()->validate([
            'hora' => '',
            'lunes' => '',
            'martes' => '',
            'miercoles' => '',
            'jueves' => '',
            'viernes' => '', ]
        );
        //dump($datos);
        try {
            Horario::create($datos); //return back(); //te redirecciona a la misma página
        }
        catch (QueryException $exception) { //controla la clave duplicada.
            //return back()->withError($exception->getMessage())->withInput(); //en caso de no encontrar en la BBDD captura la excepción y envia la info a la misma vista
            return back()->with('error', 'Hora ya introducida anteriormente');
        }
        return redirect()->route('horario');

    }

    public function actualizar(Request $request, $id){

        $validacion=$request->validate([
        'lunes' => 'required',
        'martes' => 'required',
        'miercoles' => 'required',
        'jueves' => 'required',
        'viernes' => 'required',
        ]);
       
        Horario::whereId($id)->update($validacion); //otra opción

        return redirect()->route('horario');
      
    } 


    public function borrar($id)
    {
        $dato = Horario::findOrFail($id);
        $dato->delete();
        return redirect()->route('horario');
    }

  

}
