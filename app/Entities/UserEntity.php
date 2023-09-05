<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UserEntity extends Entity
{
    protected $attributes = [
        'full_name' => null,
        'email' => null,
        'password' => null,
    ];

    public function setFullName(string $fullName): self
    {
        $this->attributes['full_name'] = $fullName;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->attributes['email'] = $email;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_BCRYPT);
        return $this;
    }
}
