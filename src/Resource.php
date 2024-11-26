<?php

declare(strict_types=1);

namespace Del\Passport;

use function get_class;

class Resource implements ResourceInterface
{
    public function __construct(
        private readonly object $object,
        private readonly string $idMethod = 'getId'
    ) {}

    public function getResourceType(): string
    {
        return get_class($this->object);
    }

    public function getResourceId(): int
    {
        return $this->object->{$this->idMethod}();
    }

    public function getObject(): object
    {
        return $this->object;
    }
}
