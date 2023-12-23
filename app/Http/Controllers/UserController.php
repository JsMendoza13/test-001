<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $inputs["password"] = Hash::make(trim($request->password));
        $studen = User::create($inputs);
        return response()->json([
            'data' => $studen,
            'mensaje' => "Registrado con exito.",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $studen = User::find($id);
        if (isset($studen)) {
            return response()->json([
                'data' => $studen,
                'mensaje' => "Encontrado con exito.",
            ]);;
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No existe.",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $studen = User::find($id);
        if (isset($studen)) {
            $studen->first_name = $request->first_name;
            $studen->last_name = $request->last_name;
            $studen->email = $request->email;
            $studen->password = Hash::make($request->password);
            if ($studen->save()) {
                return response()->json([
                    'data' => $studen,
                    'mensaje' => "Usuario actualizado con exito.",
                ]);;
            } else {
                return response()->json([
                    'error' => true,
                    'mensaje' => "No logro actualizar el usuario.",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No existe el usuario.",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $studen = User::find($id);
        if (isset($studen)) {
            $res = User::destroy($id);
            if ($res) {
                return response()->json([
                    'data' => $studen,
                    'mensaje' => "Eliminado con exito.",
                ]);;
            } else {
                return response()->json([
                    'data' => $studen,
                    'mensaje' => "No existe.",
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'mensaje' => "No existe.",
            ]);
        }
    }
}
