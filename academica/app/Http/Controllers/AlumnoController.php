<?php
namespace App\Http\Controllers;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //select * from alumnos
        return Alumno::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //insert into alumnos values...
        Alumno::create($request->all());
        return response()->json(['msg'=>'ok']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        //select * from alumnos where idAlumno=?
        return $alumno;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        //update alumnos set ... where id=? X
        //update alumnos set ... where idAlumno=? 
        //$alumno->update($request->all());
        $alumno::where('idAlumno', $request['idAlumno'])->update([
            'codigo'=>$request['codigo'],
            'nombre'=>$request['nombre'],
            'direccion'=>$request['direccion'],
            'telefono'=>$request['telefono'],
            'dui'=>$request['dui'],
        ]);
        return response()->json(['msg'=>'ok'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Alumno $alumno)
    {
        //delete from alumnos where id=? X
        //delete from alumnos where idAlumno=? 
        //$alumno->delete();
        $alumno::where('idAlumno', $request['idAlumno'])->delete();
        return response()->json(['msg'=>'ok'], 200);
    }
}
