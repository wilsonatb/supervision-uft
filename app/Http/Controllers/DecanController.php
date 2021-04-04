<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Decan;
use App\Parameter;
use App\School;

class DecanController extends Controller
{
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        $decan = new Decan();

        // Obtener todos los lapsos
        $decans = $decan->all();
        
        return view('admin.decan',[
            'decans' => $decans,
            'edit' => 'false'
        ]);
    }

    public function save(Request $request){
		
		// Validación
		$validate = $this->validate($request, [
			'decan' => 'string|required|unique:decan,name',
            'decan_name' => 'string|required',
            'document' => 'string|required',
            'phone' => 'string|required',
            'email' => 'string|required'
		]);

        // Recoger datos
		$name = $request->input('decan');
        $decan_name = $request->input('decan_name');
        $document = $request->input('document');
        $phone = $request->input('phone');
        $email = $request->input('email');
		
        // Asigno los valores a mi nuevo objeto a guardar
		$decan = new Decan();
		$decan->name = $name;
        $decan->decan_name = $decan_name;
        $decan->document = $document;
        $decan->phone = $phone;
        $decan->email = $email;

        // Guardar en la bd
		$decan->save();

        // Obtener todos los lapsos
        $decans = $decan->all();
		
		// Redirección
		return redirect()->route('decan', ['decans' => $decans, 'edit' => 'false'])
						 ->with([
							'message' => 'Decanato agregado correctamente'
						 ]);
	}

    public function update(Request $request)
    {

        $id = $request->input('id');

        // Validación del formulario
        $validate = $this->validate($request, [
            'decan' => 'string|required|unique:decan,name,' . $id,
            'decan_name' => 'string|required',
            'document' => 'string|required',
            'phone' => 'string|required',
            'email' => 'string|required',
        ]);

       // Recoger datos
		$name = $request->input('decan');
        
        $decan_name = $request->input('decan_name');
        $document = $request->input('document');
        $phone = $request->input('phone');
        $email = $request->input('email');

        // Asignar nuevos valores al objeto del usuario
        $decan = Decan::find($id);

        $decan->name = $name;
        $decan->decan_name = $decan_name;
        $decan->document = $document;
        $decan->phone = $phone;
        $decan->email = $email;


        // Ejecutar consulta y cambios en la base de datos
        $decan->update();

        
        return redirect()->route('decan', ['id' => $decan->id, 'edit' => 'false'])
                ->with(['message' => 'Decanato actualizado correctamente']);
        
    }

    public function edit($id)
    {
        //Encontrar un usuario
        $decan = Decan::find($id);

        // Obtener todos los lapsos
        $decans = $decan->all();

        return view('admin.decan', [
            'decan' => $decan,
            'decans' => $decans,
            'edit' => 'true'
        ]);
    }

    public function list(Request $request)
    {
        // Obtener todos los datos
        $decan = new Decan();

        $decans = $decan->all();


        return view('admin.listDecans', [
            'decans' => $decans
        ]);
    }

    public function delete($id)
    {
        // Conseguir datos del usuario
        $decan = Decan::find($id);
        $parameters = Parameter::where('decan_id', $id)->get();

        // Eliminar de parametros
			if($parameters && count($parameters) >= 1){
				foreach($parameters as $parameter){
					$parameter->delete();
				}
			}

        $school = School::where('decan_id', $id)->delete();
    
        // Eliminar usuario
        $decan->delete();

        return redirect()->route('decan')
						 ->with([
							'message' => 'decanato eliminado correctamente!!'
						 ]);
    }
}
