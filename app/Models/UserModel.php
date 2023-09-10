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

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';

    protected $validationLoginRules = [
        'email' => 'required|valid_email|max_length[100]',
        'password' => 'required|max_length[50]',
    ];

    protected $validationLoginMessages = [
        'email' => [
            'required' => 'Email is required',
        ],
        'password' => [
            'required' => 'Password is required',
        ],
    ];

    protected $validationRegisterRules = [
        'email' => 'required|valid_email|max_length[100]|is_unique[users.email]',
        'password' => 'required',
        'confirm_password' => 'required|max_length[100]|matches[password]',
        'full_name' => 'required|max_length[100]',
    ];

    protected $validationRegisterMessages = [
        'email' => [
            'required' => 'Email is required',
            'is_unique' => 'Email already exists, please input another email',
        ],
        'password' => [
            'required' => 'Password is required',
        ],
        'confirm_password' => [
            'required' => 'Confirm Password is required',
            'matches' => 'Confirm Password does not match Password',
        ],
        'full_name' => [
            'required' => 'Full Name is required',
        ],
    ];
}
