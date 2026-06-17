<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatModel extends Model
{
    protected $table            = 'Achat';
    protected $primaryKey       = 'id_achat';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'id_caisse',
        'id_produit',
        'quantite_achetee',
        'num_ticket'
    ];

    protected $validationRules = [
        'id_caisse' => [
            'rules'  => 'required|integer',
            'errors' => [
                'required' => 'La caisse est obligatoire.'
            ]
        ],
        'id_produit' => [
            'rules'  => 'required|integer',
            'errors' => [
                'required' => 'Le produit est obligatoire.'
            ]
        ],
        'quantite_achetee' => [
            'rules'  => 'required|integer|greater_than[0]',
            'errors' => [
                'required'   => 'La quantité achetée est obligatoire.',
                'greater_than' => 'La quantité doit être supérieure à 0.'
            ]
        ],
        'num_ticket' => [
            'rules'  => 'required|integer',
            'errors' => [
                'required' => 'Le numéro de ticket est obligatoire.'
            ]
        ]
    ];
}