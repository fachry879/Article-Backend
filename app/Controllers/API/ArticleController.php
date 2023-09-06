<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ArticleModel;
use CodeIgniter\API\ResponseTrait;

class ArticleController extends ResourceController
{
    use ResponseTrait;

    /**
     * Get list article
     */
    public function index()
    {
        $model = new ArticleModel();
        $data = $model->findAll();
        return $this->respond($data);
    }

    /**
     * Create new Article
     */
    public function create()
    {
        $model = new ArticleModel();

        if (!$this->validate($model->validationRules, $model->validationMessages)) {
            $response = [
                'status' => 'error',
                'message' => $this->validator->getErrors(),
            ];
        } else {

            $data = [
                'title' => $this->request->getVar('title'),
                'content' => $this->request->getVar('content'),
                'category' => $this->request->getVar('category'),
                'writer' => 1,
                'slug' => 'lorem ipsum',
            ];

            $model->save($data);

            $response = [
                'status' => 'success',
                'message' => 'Article created',
            ];
        }

        return $this->respondCreated($response);
    }

    /**
     * Get data Article
     */

    public function show($id = null)
    {
        $model = new ArticleModel();
        $data = $model->where('id', $id)->first();

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Article found');
        }
    }

    /**
     * Update data Article
     */
    public function update($id = null)
    {
        $model = new ArticleModel();
        $id = $this->request->getVar('id');
        $data = [
            'title' => $this->request->getVar('title'),
            'content' => $this->request->getVar('content'),
            'category' => $this->request->getVar('category'),
        ];
        $model->update($data);

        $response = [
            'status' => 'success',
            'message' => 'Article updated',
        ];

        return $this->respond($response);
    }

    /**
     * Delete data Article
     */
    public function delete($id = null)
    {
        $model = new ArticleModel();
        $data = $model->where('id', $id)->delete($id);

        if ($data) {
            $model->delete($id);
            $response = [
                'status' => 'success',
                'message' => 'Article deleted',
            ];

            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Article found or already deleted');
        }
    }
}
