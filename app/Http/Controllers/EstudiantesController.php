<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Estudiante::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $studen = Estudiante::create($inputs);
        return response()->json([
            'data' => $studen,
            'mensaje' => "Estudiante agregado con exito.",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $studen = Estudiante::find($id);
        if(isset($studen)){
            return response()->json([
                'data' => $studen,
                'mensaje' => "Estudiante encontrado con exito.",
            ]);;
        }else{
            return response()->json([
                'error' => true,
                'mensaje' => "No existe el estudiante.",
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $studen = Estudiante::find($id);
        if (isset($studen)) {
            $studen->nombre = $request->nombre;
            $studen->apellido = $request->apellido;
            $studen->foto = $request->foto;
            if ($studen->save()) {
                return response()->json([
                    'data' => $studen,
                    'mensaje' => "Estudiante con exito.",
                ]);;
            } else {
                return response()->json([
                    'error' => true,
                    'mensaje' => "No logro actualizar el estudiante.",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No existe el estudiante.",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $studen=Estudiante::find($id);
        if (isset($studen)) {
            $res=Estudiante::destroy($id);
            if ($res) {
                return response()->json([
                    'data' => $studen,
                    'mensaje' => "Estudiante fue eliminado con exito.",
                ]);;
            } else {
                return response()->json([
                    'data' => $studen,
                    'mensaje' => "Estudiante no existe.",
                ]);
            }
        }else{ 
            return response()->json([
            'error' => true,
            'mensaje' => "Estudiante no existe.",
              ]);
         }
    }
}