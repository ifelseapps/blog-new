<?php

namespace App\Http\Controllers;

use App\UseCases\BlogPostUseCases;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function create()
    {
        $useCase = new BlogPostUseCases();
        return $useCase->create();
    }
}
