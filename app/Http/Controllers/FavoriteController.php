<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_id)
    {
        if($user_id){
            $user = User::find($user_id);
        return $user->favorites;
        }
        return response()->json(['message' => "not found"],400);
        
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
    public function store($user_id, $produit_id)
    {
        if ($user_id) {
            $user = User::find($user_id);
            $user->favorites()->syncWithoutDetaching($produit_id);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id, $produit_id)
    {
        if($user_id){
            $user = User::find($user_id);
        $user->favorites()->detach($produit_id);
        }
        
    }
}
