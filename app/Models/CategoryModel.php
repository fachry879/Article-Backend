<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\CategoryEntity;

class CategoryModel extends Model
{

    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $returnType       = CategoryEntity::class;
    protected $allowedFields    = ['name'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
}
