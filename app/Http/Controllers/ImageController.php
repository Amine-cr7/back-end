<?php

namespace App\Http\Controllers;

use App\Models\Image;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Image::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            foreach ($request->file('images') as $image){
                $path = $image->store('images','public');
                Image::create([
                    'produit_id' => $request['produit_id'],
                    'image' => $path,
                ]);
            }
        return response()->json(['yess',201]);
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
        $image = Image::find($id);
        $image->delete();
    }
}
