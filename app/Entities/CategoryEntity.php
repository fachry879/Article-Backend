<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class CategoryEntity extends Entity
{
    protected $attributes = [
        'name' => null,
    ];

    public function setName(string $name): self
    {
        $this->attributes['name'] = $name;
        return $this;
    }
}
