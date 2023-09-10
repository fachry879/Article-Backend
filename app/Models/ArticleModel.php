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

    public function getDataArticle($article_id = null)
    {
        return $this->db->table('articles')
            ->join('categories', 'categories.id = articles.category')
            ->join('users', 'users.id = articles.writer')
            ->select('articles.*')
            ->select('categories.name as article_category')
            ->select('users.full_name as article_writer')
            ->where('articles.id', $article_id)
            ->get()->getResultObject();
    }
}
