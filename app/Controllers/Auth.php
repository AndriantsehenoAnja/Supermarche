<?php
namespace App\Controllers;
use App\Models\UtilisateurModel;

class Auth extends BaseController {
    
    public function login() {
        return view('auth/index');
    }

    public function connexion() {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UtilisateurModel();
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            // On le connecte en session
            $session->set([
                'username' => $user['username'],
                'is_logged_in' => true
            ]);
            // On le redirige vers le choix de la caisse
            return redirect()->to(base_url('caisse'));
        } else {
            $session->setFlashdata('erreur', 'Identifiants incorrects.');
            return redirect()->to(base_url('/'));
        }
    }
}