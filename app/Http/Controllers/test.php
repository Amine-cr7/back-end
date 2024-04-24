<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;

class test extends Controller
{
    public function store(Request $request,$id)
    {
        $user = User::find(1);
        $cart = null;
        if($user->cart){
            $cart = $user->cart;
        }else{
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->save();
        }
        $produit = Produit::find($id);
        $ext_produit = $cart->produits()->where('produit_id',$id)->first();
        if($ext_produit){
            $ext_produit->pivot->qnt++;
            $ext_produit->pivot->save();
        }else{
            $cart->produits()->attach($produit,['qnt' => 1]);
        }
        return "yessssss";
    }
}
