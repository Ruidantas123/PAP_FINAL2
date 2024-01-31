<?php

namespace App\Http\Controllers\api;

use App\Models\componente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class componenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $componente = componente::all();
        if($componente->count() > 0){
           
               return response()->json([
                'status' => 200,
                'components' => $componente
               ], 200);
        }else{

            return response()->json([
                'status' => 404,
                'status_menssage' => 'No Records Found'
               ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'quantidade' => 'required|int|max:50',
            'dimensoes' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        } else {
            $componente = componente::create([
                'name' => $request->name,
                'tipo' => $request->tipo,
                'quantidade' => $request->quantidade,
                'dimensoes' => $request->dimensoes,
                'updated_at' => now(),
                'created_at' => now(),
            ]);
        }

        if ($componente) {
            return response()->json([
                'status' => 200,
                'message' => 'Component Created Successfully',
                'component' => $componente,
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something Went Wrong!',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $componente = componente::find($id);
    
        if ($componente) {
            return response()->json([
                'status' => 200,
                'component' => $componente,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Resource not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $componente = componente::find($id);

    if (!$componente) {
        return response()->json([
            'status' => 404,
            'message' => 'Resource not found',
        ], 404);
    }

    // Validate the request data
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'tipo' => 'required|string|max:255',
        'quantidade' => 'required|int|max:50',
        'dimensoes' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'errors' => $validator->messages(),
        ], 422);
    }

    // Update the resource
    $componente->update([
        'name' => $request->name,
        'tipo' => $request->tipo,
        'quantidade' => $request->quantidade,
        'dimensoes' => $request->dimensoes,
        'updated_at' => now(),
    ]);

    return response()->json([
        'status' => 200,
        'message' => 'Resource updated successfully',
        'component' => $componente,
    ], 200);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $componente = componente::find($id);

    if (!$componente) {
        return response()->json([
            'status' => 404,
            'message' => 'Resource not found',
        ], 404);
    }

    // Delete the resource
    $componente->delete();

    return response()->json([
        'status' => 200,
        'message' => 'Resource deleted successfully',
    ], 200);
}
}
