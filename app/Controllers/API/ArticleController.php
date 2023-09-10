<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;

class ArticleController extends ResourceController
{
    use ResponseTrait;

    /**
     * Get List Category
     */

    public function getCategory()
    {
        $model = new CategoryModel();
        $data = $model->findAll();

        if (empty($data)) {
            $response = [
                'status' => 'error',
                'message' => 'Category list not found, please add some Category',
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $data,
                'message' => 'Success get list Category'
            ];
        }

        return $this->respondCreated($response);
    }

    /**
     * Get list article
     */
    public function index()
    {
        $model = new ArticleModel();
        $data = $model->orderBy('id', 'desc')->findAll();

        if (empty($data)) {
            $response = [
                'status' => 'error',
                'message' => 'Article list not found, please add some Article',
            ];
        } else {
            $response = [
                'status' => 'success',
                'data' => $data,
                'message' => 'Success get Article list',
            ];
        }

        return $this->respondCreated($response);
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
                'data' => $this->validator->getErrors(),
                'message' => 'Validation Error, please check again',
            ];
        } else {
            $data = [
                'title' => $this->request->getVar('title'),
                'content' => $this->request->getVar('content'),
                'category' => $this->request->getVar('category'),
                'writer' => 1,
                'publish_date' => Time::now('Asia/Jakarta', 'en_US'),
                'slug' => url_title(strtolower($this->request->getVar('title'))),
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

    public function show($article_id = null)
    {
        $model = new ArticleModel();
        // $data = $model->where('id', $article_id)->first();
        $data = $model->getDataArticle($article_id);

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Article found');
        }
    }

    /**
     * Update data Article
     */
    public function update($article_id = null)
    {

        $model = new ArticleModel();

        if (!$this->validate($model->validationRules, $model->validationMessages)) {
            $response = [
                'status' => 'error',
                'data' => $this->validator->getErrors(),
                'message' => 'Validation Error, please check again',
            ];
        } else {

            if ($model->find($article_id)) {

                $data = [
                    'title' => $this->request->getVar('title'),
                    'content' => $this->request->getVar('content'),
                    'category' => $this->request->getVar('category'),
                    // 'writer' => 1,
                    // 'publish_date' => Time::now('Asia/Jakarta', 'en_US'),
                    'slug' => url_title(strtolower($this->request->getVar('title'))),
                ];

                $model->update($article_id, $data);

                $response = [
                    'status' => 'success',
                    'message' => 'Article updated',
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'messages' => 'No Article found',
                ];
            }
        }

        return $this->respondCreated($response);
    }

    /**
     * Delete data Article
     */
    public function delete($article_id = null)
    {
        $model = new ArticleModel();
        $data = $model->find($article_id);

        if (!empty($data)) {
            $model->delete($article_id);

            $response = [
                'status' => 'success',
                'message' => 'Article deleted',
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No Article found or already deleted',
            ];
        }

        return $this->respondCreated($response);
    }
}
