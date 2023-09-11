<?php

namespace App\Controllers\API;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Libraries\JWTLibrary;

class UserController extends ResourceController
{
    use ResponseTrait;

    /**
     * Login User
     */
    public function login()
    {
        $model = new UserModel();

        if (!$this->validate($model->validationLoginRules, $model->validationLoginMessages)) {
            $response = [
                'status' => 'error',
                'data' => $this->validator->getErrors(),
                'message' => 'Validation Error, please check again',
            ];
        } else {

            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $user = $model->where('email', $email)->first();

            if ($user) {
                $confirm_pass = password_verify($password, $user->password);

                if ($confirm_pass) {

                    $jwt = new JWTLibrary;
                    $token = $jwt->token();

                    $response = [
                        'status' => 'success',
                        'token' => $token,
                        'id_user' => $user->id,
                        'message' => 'Login Success',
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Invalid Password, Please try again',
                    ];
                }
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Invalid Email, please try again',
                ];
            }
        }

        return $this->respondCreated($response);
    }

    /**
     * User Register
     */
    public function register()
    {
        $model = new UserModel();

        if (!$this->validate($model->validationRegisterRules, $model->validationRegisterMessages)) {
            $response = [
                'status' => 'error',
                'data' => $this->validator->getErrors(),
                'message' => 'Validation Error, please check again',
            ];
        } else {
            $data = [
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'full_name' => $this->request->getVar('full_name'),
            ];

            $model->save($data);

            $response = [
                'status' => 'success',
                'message' => 'Register success, you can login using your account.',
            ];
        }

        return $this->respondCreated($response);
    }

    /**
     * Get User Login
     */
    public function show($id = null)
    {
        $model = new UserModel();
        $data = $model->where('id', $id)->first();

        return $this->respond($data);
    }
}
