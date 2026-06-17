<?php

namespace App\Models;

use CodeIgniter\Model;

class ProduitModel extends Model
{
    protected $table            = 'Produit';
    protected $primaryKey       = 'id_produit';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'designation',
        'prix_unitaire'
    ];

    protected $validationRules = [
        'designation' => [
            'rules'  => 'required|string|max_length[255]',
            'errors' => [
                'required' => 'La désignation est obligatoire.'
            ]
        ],
        'prix_unitaire' => [
            'rules'  => 'required|numeric|greater_than_equal_to[0]',
            'errors' => [
                'required' => 'Le prix unitaire est obligatoire.',
                'numeric'  => 'Le prix doit être un nombre valide.'
            ]
        ]
    ];
}