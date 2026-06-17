<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CaisseModel;

class Caisse extends BaseController
{
    public function index()
    {
        $caisseModel = new CaisseModel();
        
        $data['caisses'] = $caisseModel->findAll();
        return view('caisse/index', $data);
    }

    public function valider()
    {
        $session = session();
        $idCaisse = $this->request->getPost('id_caisse');

        if ($idCaisse) {
            $caisseModel = new CaisseModel();
            $caisse = $caisseModel->find($idCaisse);

            if ($caisse) {
                $session->set([
                    'id_caisse'  => $caisse['id_caisse'],
                    'nom_caisse' => $caisse['nom_caisse'],
                    'num_ticket' => rand(1000, 9999) 
                ]);

                return redirect()->to(base_url('achats'));
            }
        }

        return redirect()->to(base_url('/'));
    }

}