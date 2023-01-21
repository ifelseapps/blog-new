<?php

namespace App\Blog\Infrastructure\Controllers\Api;

use App\Blog\UseCases\BlogPostUseCases;
use App\Http\Controllers\Web\Controller;

class BlogPostController extends Controller
{
    public function create()
    {
        $useCase = new BlogPostUseCases();
        return $useCase->create();
    }
}
