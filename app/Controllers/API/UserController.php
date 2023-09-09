<?php

namespace App\Controllers\API;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use Firebase\JWT\JWT;

class UserController extends ResourceController
{
    use ResponseTrait;

    /**
     * Login User
     */
    public function login()
    {
        $model = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $model->where('email', $email)->first();

        if (is_null($user)) {
            $response = [
                'status' => 'error',
                'message' => 'Invalid Email or Password, please try again',
            ];
        }

        $confirm_pass = password_verify($password, $user['password']);

        if (!$confirm_pass) {
            $response = [
                'status' => 'error',
                'message' => 'Invalid Email or Password, please try again'
            ];
        }

        $key = getenv('JWT_SECRET');
        $issued_at = time(); //current time stamp value
        $expired = $issued_at + 3600;

        $payload = array(
            'iss' => 'User Login', //issuer of the JWT
            'audience' => 'User', //Audience that the JWT
            'subject' =>  'Login to App', //Subject to the JWT
            'issued_at' => $issued_at, //Time the JWT issued at
            'expired' => $expired, //Expiration time of token
            'email' => $user['email'],
        );

        $token = JWT::encode($payload, $key, 'HS256');

        $response = [
            'status' => 'success',
            'token' => $token,
            'message' => 'Login success',
        ];

        return $this->respondCreated($response);
    }

    /**
     * User Register
     */
    public function register()
    {
        $model = new UserModel();

        if (!$this->validate($model->validationRules, $model->validationMessages)) {
            $response = [
                'status' => 'error',
                'message' => $this->validator->getErrors(),
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
                'message' => 'Register success',
            ];
        }

        return $this->respondCreated($response);
    }
}
