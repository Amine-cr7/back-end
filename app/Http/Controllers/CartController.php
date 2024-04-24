<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_id)
    {
        if ($user_id) {
            $user = User::find($user_id);
            return $user->cart->produits;
        }
        return response()->json(['message' => 'error'],404);
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
    public function store(Request $request, $user_id, $produit_id)
    {
        if ($user_id) {
            $user = User::find($user_id);
            $cart = null;
            if ($user->cart) {
                $cart = $user->cart;
            } else {
                $cart = new Cart;
                $cart->user_id = $user_id;
                $cart->save();
            }
            $produit = Produit::find($produit_id);
            $ext_produit = $cart->produits()->where('produit_id', $produit_id)->first();
            if ($ext_produit) {
                $ext_produit->pivot->qnt += $request['qnt'];
                $ext_produit->pivot->save();
            } else {
                $cart->produits()->attach($produit, ['qnt' => $request['qnt']]);
            }
            
        
        }
    
    }
    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $user_id)
    {
        if ($user_id) {
            $user = User::find($user_id);
            foreach ($request->all() as $produit_id => $qnt) {
                $user->cart->produits()->updateExistingPivot($produit_id, ['qnt' => $qnt]);
            }
            return response()->json(['message' => 'update with success']);
        }
        return response()->json(['message' => 'not auth']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id, $produit_id)
    {
        if ($user_id) {
            $user = User::find($user_id);
            $user->cart->produits()->detach($produit_id);
            return response()->json(['message' => 'deleted with success']);
        }
    }
}
