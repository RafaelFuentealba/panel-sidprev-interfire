<?php

namespace App\Models;

use CodeIgniter\Model;

class InterfazModel extends Model
{
    protected $table      = 'public."interfaces"';
    protected $primaryKey = 'interfaz_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['interfaz_id', 'nombre', 'indice_riesgo', 'amenaza', 'vulnerabilidad'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

?>