<?php declare(strict_types=1);

namespace Del\Passport;

interface ResourceInterface
{
    public function getResourceType(): string;
    public function getResourceId(): int;
}
