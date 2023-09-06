<?php

namespace App\Models;

use App\Entities\UserEntity;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['email', 'password', 'full_name'];
    protected $returnType       = UserEntity::class;


    protected $validationRules = [
        'email' => 'required|valid_email|max_length[100]',
        'password' => 'required|max_length[50]',
        'confirm_password' => 'required|max_length[100]|matches[password]',
        'full_name' => 'required|max_length[100]',
    ];

    protected $validationMessages = [
        'email' => [
            'required' => 'Email is required',
        ],
        'password' => [
            'required' => 'Password is required',
        ],
        'confirm_password' => [
            'required' => 'Confirm Password is required',
        ],
        'full_name' => [
            'required' => 'Full Name is required',
        ],
    ];
}
