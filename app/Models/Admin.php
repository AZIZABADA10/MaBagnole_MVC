<?php

namespace App\Models;

use App\Config\Database;
use PDO;


class Admin extends Utilisateur 
{
    public function __construct($id_utilisateur,$nom,$email,$role)
    {
        parent:: __construct($id_utilisateur,$nom,$email,$role);
    }

}



