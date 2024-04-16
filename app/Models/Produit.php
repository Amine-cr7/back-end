<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
    public function commandes(){
        return $this->belongsToMany(Commande::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function favoritedBy(){
        return $this->belongsToMany(User::class,'favorites');
    }
}