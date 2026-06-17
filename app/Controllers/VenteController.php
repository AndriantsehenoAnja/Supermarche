<?php

namespace App\Controllers;

use App\Models\AchatModel;
use App\Models\MvtStockModel;
use CodeIgniter\API\ResponseTrait;

class VenteController extends BaseController
{
    use ResponseTrait;

    public function enregistrerAchat()
    {
        // 1. Récupérer les données de la session
        $session = session();
        $caisseSession = $session->get('caisse');

        // Sécurité : Vérifier si la session de la caisse existe
        if (!$caisseSession || !isset($caisseSession['id_caisse'])) {
            return $this->respond([
                'status'  => 'error',
                'message' => 'Aucune session de caisse active trouvée.'
            ], 401);
        }

        $idCaisse  = $caisseSession['id_caisse'];
        // Si num_ticket n'existe pas en session, on génère un timestamp unique par sécurité
        $numTicket = $caisseSession['num_ticket'] ?? time(); 

        // 2. Récupérer le contenu JSON envoyé par le JavaScript (Fetch API)
        $json = $this->request->getJSON(true); // true pour récupérer sous forme de tableau associatif

        if (empty($json) || empty($json['produits'])) {
            return $this->respond([
                'status'  => 'error',
                'message' => 'Le panier envoyé est vide.'
            ], 400);
        }

        // 3. Initialiser les modèles
        $achatModel    = new AchatModel();
        $mvtStockModel = new MvtStockModel();

        // Utilisation d'une transaction de base de données pour garantir la cohérence des tables
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            foreach ($json['produits'] as $produit) {
                
                // Préparation des données pour la table Achat
                $donneesAchat = [
                    'id_caisse'        => $idCaisse,
                    'id_produit'       => (int) $produit['id_produit'],
                    'quantite_achetee' => (int) $produit['quantite_achetee'],
                    'num_ticket'       => (int) $numTicket
                ];

                // Validation manuelle ou automatique via le modèle lors de l'insertion
                if (!$achatModel->insert($donneesAchat)) {
                    throw new \Exception("Erreur d'insertion dans les achats : " . implode(', ', $achatModel->errors()));
                }

                // Récupération de l'ID généré pour l'achat
                $idAchatGenere = $achatModel->getInsertID();

                // Préparation des données pour la table mvtStock (SORTIE)
                $donneesMvt = [
                    'id_produit' => (int) $produit['id_produit'],
                    'quantite'   => (int) $produit['quantite_achetee'],
                    'type_mvt'   => 'SORTIE',
                    'id_achat'   => $idAchatGenere
                ];

                if (!$mvtStockModel->insert($donneesMvt)) {
                    throw new \Exception("Erreur d'insertion dans les mouvements de stock : " . implode(', ', $mvtStockModel->errors()));
                }
            }

            // Clôture et validation définitive des données en BDD
            $db->transComplete();

            if ($db->transStatus() === false) {
                return $this->respond([
                    'status'  => 'error',
                    'message' => 'L\'enregistrement a échoué lors de la transaction.'
                ], 500);
            }

            // Tout est OK : On renvoie un statut de succès
            return $this->respond([
                'status'     => 'success',
                'message'    => 'Achat et mouvements de stock enregistrés avec succès.',
                'num_ticket' => $numTicket
            ], 200);

        } catch (\Exception $e) {
            // En cas d'erreur, annuler les changements effectués durant la transaction
            $db->transRollback();

            return $this->respond([
                'status'  => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}