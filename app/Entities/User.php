<?php

declare(strict_types=1);

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Illuminate\Contracts\Auth\Authenticatable;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User implements Authenticatable
{
    use \LaravelDoctrine\ORM\Auth\Authenticatable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    protected int $id;

    #[ORM\Column(type: "string")]
    protected string $name;

    #[ORM\Column(type: "string")]
    protected string $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAuthIdentifierName(): string
    {
        return 'id';
    }

    public function getAuthIdentifier(): int
    {
        return $this->id;
    }

    public function getAuthPassword(): string
    {
        return env('SITE_PASSWORD');
    }

}
