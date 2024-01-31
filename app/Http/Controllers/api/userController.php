<?php

namespace App\Http\Controllers\api;

use App\Models\user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = user::all();
        if($user->count() > 0){
           
               return response()->json([
                'status' => 200,
                'user' => $user
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
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        } else {
            $user = user::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'email_verified_at' => now(),
                'updated_at' => now(),
                'created_at' => now(),
            ]);
        }

        if ($user) {
            return response()->json([
                'status' => 200,
                'message' => 'user Created Successfully',
                'user' => $user,
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
        $user  = user::find($id);

        if($user)
        {
            return response()->json([
                'status' => 200,
                'message' => $user,
            ], 200);
    
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Something Went Wrong!',
            ], 404);
        }
    }
    public function update(Request $request, string $id)
    {
        $user = user::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Resource not found',
            ], 404);
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }

        // Update the resource
        $user->update([
            'name' => $request->name,
            'password' => $request->password,
            'email' => $request->email,
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Resource updated successfully',
            'user' => $user,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function destroy(string $id)
    {
        $user = user::find($id);
    
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Resource not found',
            ], 404);
        }
    
        // Delete the resource
        $user->delete();
    
        return response()->json([
            'status' => 200,
            'message' => 'Resource deleted successfully',
        ], 200);
    }
}
