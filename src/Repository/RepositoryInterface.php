<?php

declare(strict_types=1);

namespace Spyck\ContentBundle\Repository;

use Spyck\ContentBundle\Entity\EntityInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('spyck.content.repository')]
interface RepositoryInterface
{
    public static function getContentName(): string;

    public function getContentEntityBySlug(string $slug, bool $active = true): ?EntityInterface;
}
