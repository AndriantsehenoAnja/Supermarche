<?php

namespace App\Models;

use CodeIgniter\Model;

class CaisseModel extends Model
{
    protected $table            = 'Caisse';
    protected $primaryKey       = 'id_caisse';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'nom_caisse'
    ];

    protected $validationRules = [
        'nom_caisse' => [
            'rules'  => 'required|string|max_length[100]',
            'errors' => [
                'required' => 'Le nom de la caisse est obligatoire.'
            ]
        ]
    ];
}