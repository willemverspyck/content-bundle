<?php

declare(strict_types=1);

namespace Spyck\ContentBundle\Service;

use Countable;
use Exception;
use IteratorAggregate;
use Spyck\ContentBundle\Repository\RepositoryInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

final class RepositoryService
{
    /**
     * @param Countable&IteratorAggregate $repositories
     */
    public function __construct(#[TaggedIterator(tag: 'spyck.content.repository', defaultIndexMethod: 'getContentName')] private iterable $repositories)
    {
    }

    /**
     * @throws Exception
     */
    public function getRepository(string $name): RepositoryInterface
    {
        foreach ($this->repositories->getIterator() as $index => $repository) {
            if ($index === $name) {
                return $repository;
            }
        }

        throw new Exception(sprintf('Repository "%s" does not exist', $name));
    }
}
