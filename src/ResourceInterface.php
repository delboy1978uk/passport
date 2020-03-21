<?php declare(strict_types=1);

namespace Del\Passport;

interface ResourceInterface
{
    /**
     * @return string
     */
    public function getResourceType(): string;

    /**
     * @return int
     */
    public function getResourceId(): int;
}