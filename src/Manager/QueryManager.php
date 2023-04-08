<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\HistoryBundle\Manager;

use Evrinoma\HistoryBundle\Dto\HistoryApiDtoInterface;
use Evrinoma\HistoryBundle\Exception\HistoryNotFoundException;
use Evrinoma\HistoryBundle\Exception\HistoryProxyException;
use Evrinoma\HistoryBundle\Model\History\HistoryInterface;
use Evrinoma\HistoryBundle\Repository\History\HistoryQueryRepositoryInterface;

final class QueryManager implements QueryManagerInterface
{
    private HistoryQueryRepositoryInterface $repository;

    public function __construct(HistoryQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @return array
     *
     * @throws HistoryNotFoundException
     */
    public function criteria(HistoryApiDtoInterface $dto): array
    {
        try {
            $history = $this->repository->findByCriteria($dto);
        } catch (HistoryNotFoundException $e) {
            throw $e;
        }

        return $history;
    }

    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @return HistoryInterface
     *
     * @throws HistoryProxyException
     */
    public function proxy(HistoryApiDtoInterface $dto): HistoryInterface
    {
        try {
            if ($dto->hasId()) {
                $history = $this->repository->proxy($dto->idToString());
            } else {
                throw new HistoryProxyException('Id value is not set while trying get proxy object');
            }
        } catch (HistoryProxyException $e) {
            throw $e;
        }

        return $history;
    }

    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @return HistoryInterface
     *
     * @throws HistoryNotFoundException
     */
    public function get(HistoryApiDtoInterface $dto): HistoryInterface
    {
        try {
            $history = $this->repository->find($dto->idToString());
        } catch (HistoryNotFoundException $e) {
            throw $e;
        }

        return $history;
    }
}
