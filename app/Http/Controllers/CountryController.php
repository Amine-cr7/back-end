<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    public function index()
    {
        
        $countriesJson = Storage::disk('local')->get('data/countries.json');
        $countries = json_decode($countriesJson, true);

        return response()->json($countries);
    }
}
