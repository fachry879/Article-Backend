<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ArticleEntity extends Entity
{
    protected $attributes = [
        'title' => null,
        'content' => null,
        'category' => null,
        'writer' => null,
        'publish_date' => null,
        'slug' => null,
    ];

    public function setTitle(string $title): self
    {
        $this->attributes['title'] = $title;
        return $this;
    }

    public function setContent(string $content): self
    {
        $this->attributes['content'] = $content;
        return $this;
    }

    public function setCategory(int $category): self
    {
        $this->attributes['category'] = $category;
        return $this;
    }

    public function setWriter(int $writer): self
    {
        $this->attributes['writer'] = $writer;
        return $this;
    }

    public function setPublishDate(string $publishDate): self
    {
        $this->attributes['publish_date'] = $publishDate;
        return $this;
    }

    public function setSlug(string $slug): self
    {
        $this->attributes['slug'] = url_title(strtolower($slug));
        return $this;
    }
}
