<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($userId = null)
    {
        if($userId){
            $user = User::find($userId);
            return $user->information;
        }
        return response()->json(['message' => 'not Found'],404);
        
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
        $user = User::find($request['userId']);
        $info = new UserInformation;
        $info->address = $request['adress'];
        $info->country = $request['country'];
        $info->city = $request['city'];
        $info->telephone = $request['tele'];
        $info->code = $request['code'];
        $user->information()->save($info);
        return response()->json('created',200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request)
    {
        $user = User::find($request['userId']);
        $user->information->address = $request['adress'];
        $user->information->code = $request['code'];
        $user->information->city = $request['city'];
        $user->information->telephone = $request['tele'];
        $user->information->country = $request['country'];
        $user->information->save();
        return response()->json('updated',200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
