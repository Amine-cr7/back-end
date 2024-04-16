<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users',
        ]);
        $user = User::create([
            'name' => $data['name'],
            'password' => Hash::make($data['password']) ,
            'email' => $data['email']
        ]);
        return $user;
    }
    public function login(Request $request){
        $user = User::where('email',$request['email'])->first();
        if(!$user || !Hash::check($request['password'],$user->password)){
            return ["error" => "Email Or Password is not Matched"];
        }
        return $user;
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
