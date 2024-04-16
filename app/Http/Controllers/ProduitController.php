<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Image;
use App\Models\Produit;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

use function PHPUnit\Framework\returnSelf;

class ProduitController extends Controller
{
    
    public function index()
    {
        return Produit::all();
    }
    public function filters(){

        return [
            'sizes' => Produit::select('size')->distinct()->pluck('size')->toArray(),
            'types' => Produit::select('type')->distinct()->pluck('type')->toArray(),
            'saisons' => Produit::select('saison')->distinct()->pluck('saison')->toArray(),
            'marques' => Produit::select('marque')->distinct()->pluck('marque')->toArray(),
        ];
    }
    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = $request['image']->store('images','public');
        $produit = Produit::create([
            'nom' => $request['nom'],
            'categorie_id' => $request['categorie_id'],
            'prix' => $request['prix'],
            'description' => $request['description'],
            'size' => $request['size'],
            'saison' => $request['saison'],
            'marque' => $request['marque'],
            'type' => $request['type'],
            'image' => $path
        ]);
        Image::create([
            'produit_id' => $produit->id,
            'image' => $path
        ]);
        return response()->json(['message' => 'created'], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        return view('admin.produit.edit',['produit' => $produit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        $data = $request->validate([
            'nom' => 'required',
            'prix' => 'required',
            'image' => 'required',
            'description' => 'required'
        ]);
        $produit->update($data);
        return redirect('/produits');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect('/produits');
    }
}