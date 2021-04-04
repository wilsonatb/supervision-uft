<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\Decan;
use App\Parameter;
use App\Subject;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        $decan = new Decan();
        $school = new School();

        // Obtener todos los datos
        $decans = $decan->all();
        $schools = $school->all();
        
        return view('admin.school',[
            'decans' => $decans,
            'schools' => $schools,
            'edit' => 'save'
        ]);
    }

    public function save(Request $request){
		
		// Validación
		$validate = $this->validate($request, [
			'decan_id' => 'integer|required',
            'code' => 'required|string|max:255|unique:school',
            'school' => 'string|required',
            'school_name' => 'string|required',
            'document' => 'string|required',
            'phone' => 'string|required',
            'email' => 'string|required'
		]);

        // Recoger datos
        $decan_id = $request->input('decan_id');
		$name = $request->input('school');
        $code = $request->input('code');

        $school_name = $request->input('school_name');
        $document = $request->input('document');
        $phone = $request->input('phone');
        $email = $request->input('email');
		
        // Asigno los valores a mi nuevo objeto a guardar
		$school = new School();
        $school->decan_id = $decan_id;
		$school->name = $name;
        $school->code = $code;

        $school->school_name = $school_name;
        $school->document = $document;
        $school->phone = $phone;
        $school->email = $email;

        // Guardar en la bd
		$school->save();

        // Obtener todos los lapsos
        $decan = new Decan();
        $decans = $decan->all();
        $schools = $school->all();
		
		// Redirección
		return redirect()->route('school', ['schools' => $schools, 'decans' => $decans, 'edit' => 'false'])
						 ->with([
							'message' => 'Escuela agregada correctamente'
						 ]);
	}

    public function show(Request $request, $id)
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        $decan = new Decan();
        $school = new School();
        

        // Obtener todos los datos
        $decans = $decan->all();
        $school = $school->find($id);
        $schools = $school->all();
        
        return view('admin.school',[
            'decans' => $decans,
            'school' => $school,
            'schools' => $schools,
            'edit' => 'true'
        ]);
    }

    public function edit(Request $request)
    {

        $id = $request->input('id');

        $decan = new Decan();

        // Validación del formulario
        $validate = $this->validate($request, [
            'decan_id' => 'integer|required',
            'code' => 'required|string|max:255|unique:school,code,' . $id,
            'school' => 'string|required',
            'school_name' => 'string|required',
            'document' => 'string|required',
            'phone' => 'string|required',
            'email' => 'string|required'
        ]);

       // Recoger datos
       $decan_id = $request->input('decan_id');
       $name = $request->input('school');
       $code = $request->input('code');

       $school_name = $request->input('school_name');
       $document = $request->input('document');
       $phone = $request->input('phone');
       $email = $request->input('email');
        

        // Asignar nuevos valores al objeto del usuario
        $school = School::find($id);

        $school->decan_id = $decan_id;
		$school->name = $name;
        $school->code = $code;

        $school->school_name = $school_name;
        $school->document = $document;
        $school->phone = $phone;
        $school->email = $email;
       


        // Ejecutar consulta y cambios en la base de datos
        $school->update();

        
        // Obtener todos los datos
        $schools = $school->all();
        $decans = $decan->all();
        
        return view('admin.school',[
            'schools' => $schools,
            'decans' => $decans,
            'section' => '',
            'edit' => 'save'
        ]);
    }

    public function list(Request $request)
    {
        // Obtener todos los datos
        $school = new School();

        $schools = $school->all();


        return view('admin.listSchools', [
            'schools' => $schools
        ]);
    }

    public function delete($id)
    {
        // Conseguir datos del usuario
        $school = School::find($id);
        $parameters = Parameter::where('school_id', $id)->get();

        // Eliminar de parametros
			if($parameters && count($parameters) >= 1){
				foreach($parameters as $parameter){
					$parameter->delete();
				}
			}

        $subject = Subject::where('school_id', $id)->delete();
    
        // Eliminar usuario
        $school->delete();

        return redirect()->route('school')
						 ->with([
							'message' => 'Escuela eliminada correctamente!!'
						 ]);
    }
}
