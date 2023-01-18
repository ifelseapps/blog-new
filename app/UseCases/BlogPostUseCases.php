<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Domain\Blog\Post;
use App\Exceptions\DomainException;
use DateTime;

class BlogPostUseCases
{
    public function create(): array
    {
        try {
            $post = new Post([
                'type' => Post::TYPE_BLOG,
                'title' => 'Следующий пост с именем на english',
                'date' => new DateTime(),
                'description' => 'Some post description for search engine',
                'keywords' => 'some, post, blog',
            ]);

            $post->addTag('firstPost');
            $post->addTag('abcd');

            $post->addText('<p>Some text about me and my blog Some text about me and my blog Some text about me and my blog Some text about me and my blog</p>');
            $post->addPictures([]);

            return ['post' => $post->toArray()];
        } catch (DomainException $e) {
            return ['error' => [
                'type' => get_class($e),
                'message' => $e->getMessage(),
            ]];
        }
    }
}
