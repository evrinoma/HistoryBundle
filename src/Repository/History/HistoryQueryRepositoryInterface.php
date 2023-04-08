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

namespace Evrinoma\HistoryBundle\Repository\History;

use Doctrine\ORM\Exception\ORMException;
use Evrinoma\HistoryBundle\Dto\HistoryApiDtoInterface;
use Evrinoma\HistoryBundle\Exception\HistoryNotFoundException;
use Evrinoma\HistoryBundle\Exception\HistoryProxyException;
use Evrinoma\HistoryBundle\Model\History\HistoryInterface;

interface HistoryQueryRepositoryInterface
{
    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @return array
     *
     * @throws HistoryNotFoundException
     */
    public function findByCriteria(HistoryApiDtoInterface $dto): array;

    /**
     * @param string $id
     * @param null   $lockMode
     * @param null   $lockVersion
     *
     * @return HistoryInterface
     *
     * @throws HistoryNotFoundException
     */
    public function find(string $id, $lockMode = null, $lockVersion = null): HistoryInterface;

    /**
     * @param string $id
     *
     * @return HistoryInterface
     *
     * @throws HistoryProxyException
     * @throws ORMException
     */
    public function proxy(string $id): HistoryInterface;
}
