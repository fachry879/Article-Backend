<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ArticleModel;

class ArticleController extends ResourceController
{
    protected $model = ArticleModel::class;
    protected $format = 'json';

    /**
     * Get list article
     */
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data, 'Success get List Article');
    }

    /**
     * Create new Article
     */
    public function create()
    {
        $data = $this->request->getPost();
        $insert = $this->save($data);

        if (!$insert) {
            return $this->fail($this->model->errors());
        }

        return $this->respondCreated($data, 'Article Created !');
    }
}
