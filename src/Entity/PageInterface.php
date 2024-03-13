<?php

declare(strict_types=1);

namespace Spyck\ContentBundle\Entity;

interface PageInterface
{
    public function getContentName(): ?string;
}
