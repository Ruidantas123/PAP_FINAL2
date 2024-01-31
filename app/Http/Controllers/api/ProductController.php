<?php

namespace App\Http\Controllers\api;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return $products->count() > 0
            ? response()->json(['status' => 200, 'products' => $products], 200)
            : response()->json(['status' => 404, 'status_message' => 'No Records Found'], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'quantidade' => 'required|numeric|max:50',
            'materiais' => 'required|string', // Add this line for the 'materiais' field
            'dimensoes' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->messages()], 422);
        }

        $product = Product::create($request->all());

        return $product
            ? response()->json(['status' => 200, 'message' => 'Product Created Successfully', 'product' => $product], 200)
            : response()->json(['status' => 500, 'message' => 'Something Went Wrong!'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = product::find($id);
    
        if ($product) {
            return response()->json([
                'status' => 200,
                'component' => $product,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Resource not found',
            ], 404);
        }
    }


    public function update(Request $request, string $id)
{
    $product = product::find($id);

    if (!$product) {
        return response()->json([
            'status' => 404,
            'message' => 'Resource not found',
        ], 404);
    }

    // Validate the request data
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'tipo' => 'required|string|max:255',
        'quantidade' => 'required|numeric|max:50',
        'materiais' => 'required|string', // Add this line for the 'materiais' field
        'dimensoes' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'errors' => $validator->messages(),
        ], 422);
    }

    // Update the resource with actual values from the request
    $product->update($request->all());

    return response()->json([
        'status' => 200,
        'message' => 'Resource updated successfully',
        'product' => $product,
    ], 200);
}
        
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $product = product::find($id);

    if (!$product) {
        return response()->json([
            'status' => 404,
            'message' => 'Resource not found',
        ], 404);
    }

    // Delete the resource
    $product->delete();

    return response()->json([
        'status' => 200,
        'message' => 'Resource deleted successfully',
    ], 200);
}

}
