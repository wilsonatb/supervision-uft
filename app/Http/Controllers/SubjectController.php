<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\School;
use Mockery\Matcher\Subset;
use App\Parameter;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        $school = new School();
        $subject = new Subject();

        // Obtener todos los datos
        $subjects = $subject->all();
        $schools = $school->all();

        return view('admin.subject', [
            'subjects' => $subjects,
            'schools' => $schools
        ]);
    }

    public function save(Request $request)
    {

        // Validación
        $validate = $this->validate($request, [
            'school_id' => 'integer|required',
            'code' => 'required|string|max:255|unique:subject',
            'subject' => 'string|required',
        ]);

        // Recoger datos
        $school_id = $request->input('school_id');
        $name = $request->input('subject');
        $code = $request->input('code');

        // Asigno los valores a mi nuevo objeto a guardar
        $school = new School();
        $subject = new Subject();

        $subject->school_id = $school_id;
        $subject->name = $name;
        $subject->code = $code;

        // Guardar en la bd
        $subject->save();

        // Obtener todos los lapsos
        $subjects = $subject->all();
        $schools = $school->all();

        // Redirección
        return redirect()->route('subject', ['subject' => $schools, 'subjects' => $subjects])
            ->with([
                'message' => 'Materia agregada correctamente'
            ]);
    }

    public function list(Request $request)
    {
        // Obtener todos los datos
        $subject = new Subject();

        $subjects = $subject->all();


        return view('admin.listSubjects', [
            'subjects' => $subjects
        ]);
    }

    public function delete($id)
    {
        // Conseguir datos del usuario
        $subject = Subject::find($id);
        $parameters = Parameter::where('subject_id', $id)->get();

        // Eliminar de parametros
			if($parameters && count($parameters) >= 1){
				foreach($parameters as $parameter){
					$parameter->delete();
				}
			}
    
        // Eliminar relacion en tabla pivote
        $subject->users()->detach();
    
        // Eliminar usuario
        $subject->delete();

        return redirect()->route('subject')
						 ->with([
							'message' => 'Materia eliminada correctamente!!'
						 ]);
    }
}
