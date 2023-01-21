<?php

declare(strict_types=1);

namespace App\Blog\Domain;

use App\Common\Exceptions\DomainException;
use App\Common\Services\Str;
use DateTime;

class Post
{
    protected string $id;

    protected string $type;

    protected string $title;

    protected DateTime $date;

    protected string|null $category;

    protected array $tags;

    protected array $content;

    protected string $description;

    protected string $keywords;

    const TYPE_BLOG = 'blog';

    const TYPE_REVIEW = 'review';

    const TYPE_TRAVEL = 'travel';

    const PREVIEW_TEXT_LENGTH = 200;

    /**
     * @param array $attributes
     * @throws DomainException
     */
    public function __construct(array $attributes)
    {
        $this->validate($attributes);

        $this->id = $attributes['id'] ?? Str::generateUUID();
        $this->type = $attributes['type'];
        $this->title = $attributes['title'] ?? '';
        $this->date = $attributes['date'];
        $this->category = $attributes['category'] ?? null;
        $this->tags = $attributes['tags'] ?? [];
        $this->content = $attributes['content'] ?? [];
        $this->description = $attributes['description'];
        $this->keywords = $attributes['keywords'];
    }

    protected array $required = [
        'type',
        'title',
        'date',
        'description',
        'keywords',
    ];

    /**
     * @param array $attributes
     * @return void
     * @throws DomainException
     */
    protected function validate(array $attributes): void
    {
        $errorFields = [];

        foreach ($this->required as $field) {
            if (empty($attributes[$field])) {
                $errorFields[] = $field;
            }
        }

        if (count($errorFields)) {
            throw new DomainException(
                'Не заполнены обязательные поля: ' . join(', ', $errorFields)
            );
        }
    }

    /**
     * @return array
     * @throws DomainException
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'preview_text' => $this->getPreviewText(),
            'slug' => $this->getSlug(),
            'date' => $this->getDateFormatted(),
            'category' => $this->category,
            'tags' => $this->tags,
            'content' => $this->content,
            'description' => $this->description,
            'keywords' => $this->keywords,
        ];
    }

    public function addText(string $text): void
    {
        $this->content[] = ['type' => ContentType::TEXT, 'text' => $text];
    }

    /**
     * @param array $pictures
     * @throws DomainException
     */
    public function addPictures(array $pictures): void
    {
        if (empty($this->content)) {
            throw new DomainException('Первый блок контента не может быть изображением');
        }

        $this->content[] = ['type' => ContentType::PICTURES, 'pictures' => $pictures];
    }

    public function addTag(string $tag): void
    {
        if (!in_array($tag, $this->tags)) {
            $this->tags[] = $tag;
            $this->sortTags();
        }
    }

    public function removeTag(string $tag): void
    {
        $this->tags = array_filter($this->tags, function (string $el) use ($tag) {
            return $el !== $tag;
        });
        $this->sortTags();
    }

    public function getSlug(): string
    {
        return Str::slugify($this->title);
    }

    public function getPreviewText(): string
    {
        if (!count($this->content)) {
            return '';
        }

        return substr(strip_tags($this->content[0]['text']), 0, static::PREVIEW_TEXT_LENGTH) . ' ...';
    }

    public function getDateFormatted(): string
    {
        if (empty($this->date)) {
            return '';
        }

        if ($this->isTravelPost()) {
            return $this->date->format('Y-m');
        }

        return $this->date->format('Y-m-d');
    }

    protected function sortTags(): void
    {
        sort($this->tags);
    }

    protected function isBlogPost(): bool
    {
        return $this->type === static::TYPE_BLOG;
    }

    protected function isReviewPost(): bool
    {
        return $this->type === static::TYPE_REVIEW;
    }

    protected function isTravelPost(): bool
    {
        return $this->type === static::TYPE_TRAVEL;
    }
}
