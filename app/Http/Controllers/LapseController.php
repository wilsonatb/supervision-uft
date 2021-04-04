<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lapse;
use App\Parameter;

class LapseController extends Controller
{
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        $lapse_obj = new Lapse();

        // Obtener todos los lapsos
        $lapses = $lapse_obj->all();
        
        return view('admin.lapse',[
            'lapses' => $lapses,
            'lapse' => '',
            'route' => 'save'
        ]);
    }

    public function save(Request $request){
		
        
		// Validación
		$validate = $this->validate($request, [
			'lapse' => 'string|required|unique:lapse',
            'date_range' => 'string|required'
		]);

        // Recoger datos
		$lapse = $request->input('lapse');
        $date_range = $request->input('date_range');
		
        // Asigno los valores a mi nuevo objeto a guardar
		$lapse_obj = new Lapse();
		$lapse_obj->lapse = $lapse;
        $lapse_obj->date_range = $date_range;

        // Guardar en la bd
		$lapse_obj->save();

        // Obtener todos los lapsos
        $lapses = $lapse_obj->all();
		
		// Redirección
		return redirect()->route('lapse', ['lapses' => $lapses, 'route' => 'save'])
						 ->with([
							'message' => 'Lapso agregado correctamente'
						 ]);
	}

    public function show(Request $request, $id)
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        $lapse_obj = new Lapse();
        

        // Obtener todos los datos
        $lapses = $lapse_obj->all();
        $lapse = $lapse_obj->find($id);
        
        return view('admin.lapse',[
            'lapses' => $lapses,
            'lapse' => $lapse,
            'route' => 'edit'
        ]);
    }

    public function edit(Request $request)
    {

        $id = $request->input('id');

        // Validación del formulario
        $validate = $this->validate($request, [
            'lapse' => 'string|required|unique:lapse,lapse,' . $id,
            'date_range' => 'string|required'
        ]);

       // Recoger datos
		$lapse = $request->input('lapse');
        

        // Asignar nuevos valores al objeto del usuario
        $lapse_obj = Lapse::find($id);

        $lapse_obj->lapse = $lapse;
       


        // Ejecutar consulta y cambios en la base de datos
        $lapse_obj->update();

        
        // Obtener todos los datos
        $lapses = $lapse_obj->all();
        
        return view('admin.lapse',[
            'lapses' => $lapses,
            'lapse' => '',
            'route' => 'save'
        ]);
    }

    public function delete($id)
    {
        // Conseguir datos del usuario
        $lapse = Lapse::find($id);
        $parameters = Parameter::where('lapse_id', $id)->get();

        // Eliminar de parametros
			if($parameters && count($parameters) >= 1){
				foreach($parameters as $parameter){
					$parameter->delete();
				}
			}
    
       
    
        // Eliminar 
        $lapse->delete();

        $lapse_obj = new Lapse();

        // Obtener todos los lapsos
        $lapses = $lapse_obj->all();

        return redirect()->route('lapse', ['lapses' => $lapses, 'route' => 'save'])
						 ->with([
							'message' => 'Lapso eliminado correctamente!!'
						 ]);
    }
}
