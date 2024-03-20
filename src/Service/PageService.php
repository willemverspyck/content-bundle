<?php

declare(strict_types=1);

namespace Spyck\ContentBundle\Service;

use Exception;
use Spyck\ContentBundle\Entity\EntityInterface;
use Spyck\ContentBundle\Entity\PageInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class PageService
{
    public function __construct(private readonly RepositoryService $repositoryService, private readonly RequestStack $requestStack)
    {
    }

    /**
     * @throws Exception
     */
    public function getEntity(PageInterface $page, string $slug): ?EntityInterface
    {
        $repository = $this->repositoryService->getRepository($page->getContentName());

        $request = $this->requestStack->getMainRequest();

        if ($request->query->has('hash')) {
            $hash = $request->query->get('hash');

            $content = $repository->getContentEntityBySlug($slug, false);

            if (null === $content) {
                throw new NotFoundHttpException(sprintf('Content not found (%s)', $slug));
            }

            if ($content->getContentHash() === $hash) {
                return $content;
            }

            throw new NotFoundHttpException(sprintf('Content preview not found (%s)', $slug));
        }

        $content = $repository->getContentEntityBySlug($slug);

        if (null === $content) {
            throw new NotFoundHttpException(sprintf('Content not found (%s)', $slug));
        }

        return $content;
    }
}
