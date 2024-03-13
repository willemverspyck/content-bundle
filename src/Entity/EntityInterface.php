<?php

declare(strict_types=1);

namespace Spyck\ContentBundle\Entity;

interface EntityInterface
{
    public function getContentName(): string;

    public function getContentDescription(): string;

    public function getContentUrl(): ?string;

    public function getContentImage(): ?string;

    public function getContentHash(): string;
}
