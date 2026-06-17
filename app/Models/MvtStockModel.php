<?php

namespace App\Models;

use CodeIgniter\Model;

class MvtStockModel extends Model
{
    protected $table            = 'mvtStock';
    protected $primaryKey       = 'id_mvt';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'id_produit',
        'quantite',
        'type_mvt',
        'date_mvt',
        'id_achat'
    ];

    // Utilisation des fonctionnalités de gestion de date natives de CI4
    protected $useTimestamps = false; // Géré par le 'DEFAULT CURRENT_TIMESTAMP' de SQLite

    protected $validationRules = [
        'id_produit' => [
            'rules'  => 'required|integer',
            'errors' => [
                'required' => 'Le produit est obligatoire.'
            ]
        ],
        'quantite' => [
            'rules'  => 'required|integer|greater_than[0]',
            'errors' => [
                'required'   => 'La quantité du mouvement est obligatoire.',
                'greater_than' => 'La quantité doit être supérieure à 0.'
            ]
        ],
        'type_mvt' => [
            'rules'  => 'required|in_list[ENTREE,SORTIE]',
            'errors' => [
                'required' => 'Le type de mouvement est obligatoire.',
                'in_list'  => 'Le type de mouvement doit être ENTREE ou SORTIE.'
            ]
        ],
        'id_achat' => [
            'rules'  => 'permit_empty|integer'
        ],
        'date_mvt' => [
            'rules'  => 'permit_empty|valid_date[Y-m-d H:i:s]'
        ]
    ];
}