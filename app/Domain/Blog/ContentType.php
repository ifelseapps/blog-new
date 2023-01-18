<?php

namespace App\Domain\Blog;

enum ContentType: string
{
    case TEXT = 'TEXT';
    case PICTURES = 'PICTURES';
}
