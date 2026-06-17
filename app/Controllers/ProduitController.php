<?php
namespace App\Controllers;
use config\Database;
use App\Models\ProduitModel;
class ProduitController extends BaseController{
    public function index(){
        $produit = new ProduitModel();
        $data['produits'] = $produit->findAll();
        return view('achat/index', $data);
    }
}