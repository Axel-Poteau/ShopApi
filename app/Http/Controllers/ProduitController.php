<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index(){
        $produits = Produit::all();
        return response()->json($produits);
    }

    public function store(Request $request){
        $produit = new Produit();
        $produit->nom = $request->nom;
        $produit->description = $request->description;
        $produit->prix = $request->prix;
        $produit->save();
        return response()->json([
            "message"=>"produit added"
        ],201);
    }

    public function show($id){
        $produit = Produit::find($id);
        if (!empty($produit)){
            return response()->json($produit);
        }
        else {
            return response()->json([
                "message"=>"produit not found"
            ],404);
        }
    }
    public function update(Request $request,$id){
        $produit = Produit::find($id);
        $produit->nom = $request->nom;
        $produit->description = $request->description;
        $produit->prix = $request->prix;
        $produit->save();
        return response()->json([
            "message"=>"produit edited"
        ],201);
    }
    public function destroy($id){
        if(Produit::where('id',$id)->exists()){
            $produit = Produit::find($id);
            $produit->delete();
            return response()->json([
                "message"=>"produit deleted"
            ],201);
        }
        else {
            return response()->json([
                "message"=>"produit not found"
            ],404);
        }
    }
}
