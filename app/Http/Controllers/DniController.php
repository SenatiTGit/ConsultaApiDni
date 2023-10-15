<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dni;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class DniController extends Controller
{
    //ALMACENAR
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'number' => [
                'required',
                'integer',
                Rule::unique('dnis')->where(function ($query) use ($request) {
                    return $query->where('number', $request->input('number'));
                })
            ],
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'edad' => 'required|integer|min:0',
            'estado_civil' => 'required|string',
            'fecha_nacimiento' => 'date',
            'genero' => 'string',
            'direccion' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'El número de DNI ya existe'], 400);
        }

        try {
            Dni::create($request->all());
            return response()->json(['message' => 'DNI almacenado con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al almacenar los datos'], 500);
        }
    }


    //CONSULTAR
    public function index()
    {
        try {
            $dnis = Dni::all();
            return response()->json($dnis, 200); // Código 200: OK
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al recuperar los DNIs'], 500); // Código 500: Internal Server Error
        }
    }

    //ACTUALIZAR
    public function update(Request $request, $id)
    {
        $dni = Dni::find($id);

        if (!$dni) {
            return response()->json(['error' => 'DNI no encontrado'], 404); // Código 404: Not Found
        }

        $data = $request->validate([
            'number' => [
                'required',
                'integer',
                Rule::unique('dnis')->ignore($dni->id),
            ],
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'edad' => 'required|integer|min:0',
            'estado_civil' => 'required|string',
            'fecha_nacimiento' => 'date',
            'genero' => 'string',
            'direccion' => 'string',
        ]);

        try {
            $dni->update($data);
            return response()->json(['message' => 'DNI actualizado con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el DNI'], 500);
        }
    }

    //ELIMINAR
    public function destroy($id)
    {
        $dni = Dni::find($id);

        if (!$dni) {
            return response()->json(['error' => 'DNI no encontrado'], 404);
        }

        try {
            $dni->delete();
            return response()->json(['message' => 'DNI eliminado con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el DNI'], 500);
        }
    }


}