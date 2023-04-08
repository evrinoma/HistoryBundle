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

namespace Evrinoma\HistoryBundle\Repository\Orm\History;

use Doctrine\Persistence\ManagerRegistry;
use Evrinoma\HistoryBundle\Mediator\QueryMediatorInterface;
use Evrinoma\HistoryBundle\Repository\History\HistoryRepositoryInterface;
use Evrinoma\HistoryBundle\Repository\History\HistoryRepositoryTrait;
use Evrinoma\UtilsBundle\Repository\Orm\RepositoryWrapper;
use Evrinoma\UtilsBundle\Repository\RepositoryWrapperInterface;

class HistoryRepository extends RepositoryWrapper implements HistoryRepositoryInterface, RepositoryWrapperInterface
{
    use HistoryRepositoryTrait;

    /**
     * @param ManagerRegistry        $registry
     * @param string                 $entityClass
     * @param QueryMediatorInterface $mediator
     */
    public function __construct(ManagerRegistry $registry, string $entityClass, QueryMediatorInterface $mediator)
    {
        parent::__construct($registry, $entityClass);
        $this->mediator = $mediator;
    }
}
