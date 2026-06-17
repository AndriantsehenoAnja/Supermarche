<?php
namespace App\Models;
use CodeIgniter\Model;

class UtilisateurModel extends Model {
    protected $table = 'Utilisateur';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'password'];
}