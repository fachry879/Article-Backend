<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\ArticleEntity;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $returnType = ArticleEntity::class;
    protected $allowedFields = [
        'title',
        'content',
        'category',
        'writer',
        'publish_date',
        'slug',
    ];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[100]',
        'content' => 'required',
        'category' => 'required',
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'Title is required',
        ],
        'content' => [
            'required' => 'Content is required',
        ],
        'category' => [
            'required' => 'Category is required',
        ],
    ];
}
