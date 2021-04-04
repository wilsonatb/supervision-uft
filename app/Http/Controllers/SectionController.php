<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Parameter;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        $section = new Section();

        // Obtener todos los datos
        $sections = $section->all();
        
        return view('admin.section',[
            'sections' => $sections,
            'section' => '',
            'route' => 'save'
        ]);
    }

    public function save(Request $request){
		
		// Validación
		$validate = $this->validate($request, [
			'section' => 'string|required|unique:section,name'
		]);

        // Recoger datos
		$name = $request->input('section');
		
        // Asigno los valores a mi nuevo objeto a guardar
		$section = new Section();
		$section->name = $name;

        // Guardar en la bd
		$section->save();

        // Obtener todos los lapsos
        $sections = $section->all();
		
		// Redirección
		return redirect()->route('section', ['sections' => $sections])
						 ->with([
							'message' => 'seccion agregada correctamente'
						 ]);
	}

    public function show(Request $request, $id)
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        $section = new Section();
        

        // Obtener todos los datos
        $sections = $section->all();
        $section = $section->find($id);
        
        return view('admin.section',[
            'sections' => $sections,
            'section' => $section,
            'route' => 'edit'
        ]);
    }

    public function edit(Request $request)
    {

        $id = $request->input('id');

        // Validación del formulario
        $validate = $this->validate($request, [
            'section' => 'string|required|unique:section,name,' . $id,
        ]);

       // Recoger datos
		$name = $request->input('section');
        

        // Asignar nuevos valores al objeto del usuario
        $section = Section::find($id);

        $section->name = $name;
       


        // Ejecutar consulta y cambios en la base de datos
        $section->update();

        
        // Obtener todos los datos
        $sections = $section->all();
        
        return view('admin.section',[
            'sections' => $sections,
            'section' => '',
            'route' => 'save'
        ]);
    }

    public function delete($id)
    {
        // Conseguir datos del usuario
        $section = Section::find($id);
        $parameters = Parameter::where('section_id', $id)->get();

        // Eliminar de parametros
			if($parameters && count($parameters) >= 1){
				foreach($parameters as $parameter){
					$parameter->delete();
				}
			}

       
    
        // Eliminar usuario
        $section->delete();

        return redirect()->route('section')
						 ->with([
							'message' => 'Seccion eliminada correctamente!!'
						 ]);
    }
}
