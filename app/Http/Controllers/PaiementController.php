<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($userId)
    {
        if($userId){
            $user = User::find($userId);
            return $user->commandes;
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
    public function store(Request $request)
    {
        $user = User::find($request['userId']);
        if ($user) {
            foreach ($user->commandes as $commande) {
                if ($commande->status == 'pending') {
                    $total = 0;
                    foreach ($commande->produits as $produit) {
                        $total += $produit->prix * $produit->pivot->qnt;
                    }

                    $paiement = new Paiement;
                    $paiement->status = "paye";
                    $paiement->method = $request['method'];
                    $paiement->amount = $total;
                    $paiement->commande_id = $commande->id;
                    $paiement->save();

                    $commande->status = "done";
                    $commande->save();

                    foreach ($commande->produits as $produit) {
                        $user->cart->produits()->detach($produit->id);
                    }
                    $user->cart->delete();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Paiement $paiement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paiement $paiement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paiement $paiement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paiement $paiement)
    {
        //
    }
}
