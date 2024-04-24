<?php

namespace App\Http\Controllers;

use App\Models\commande;
use App\Models\User;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_Id)
    {
        $user = User::find($user_Id);
        if ($user) {
            $commandes = $user->commandes()->where('status', 'pending')->with('produits')->get();
            return $commandes;
        }
        return response()->json(['message' => 'User not found'], 404);
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
        $user_Id = $request['user_id'];
        $user = User::find($user_Id);
        if ($user) {
            $commande = new Commande;
            $commande->status = 'pending';
            $user->commandes()->save($commande);

            $produits = $request->input('produits');
            foreach ($produits as $produit) {
                $commande->produits()->attach($produit['produit_id'], ['qnt' => $produit['quantity']]);
                
            }
            
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    /**
     * Display the specified resource.
     */
    public function show(commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(commande $commande)
    {
        //
    }
}
