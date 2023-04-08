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
use Doctrine\ORM\ORMInvalidArgumentException;
use Evrinoma\HistoryBundle\Dto\HistoryApiDtoInterface;
use Evrinoma\HistoryBundle\Exception\HistoryCannotBeSavedException;
use Evrinoma\HistoryBundle\Exception\HistoryNotFoundException;
use Evrinoma\HistoryBundle\Exception\HistoryProxyException;
use Evrinoma\HistoryBundle\Mediator\QueryMediatorInterface;
use Evrinoma\HistoryBundle\Model\History\HistoryInterface;

trait HistoryRepositoryTrait
{
    private QueryMediatorInterface $mediator;

    /**
     * @param HistoryInterface $history
     *
     * @return bool
     *
     * @throws HistoryCannotBeSavedException
     * @throws ORMException
     */
    public function save(HistoryInterface $history): bool
    {
        try {
            $this->persistWrapped($history);
        } catch (ORMInvalidArgumentException $e) {
            throw new HistoryCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param HistoryInterface $history
     *
     * @return bool
     */
    public function remove(HistoryInterface $history): bool
    {
        return true;
    }

    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @return array
     *
     * @throws HistoryNotFoundException
     */
    public function findByCriteria(HistoryApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilderWrapped($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $historys = $this->mediator->getResult($dto, $builder);

        if (0 === \count($historys)) {
            throw new HistoryNotFoundException('Cannot find history by findByCriteria');
        }

        return $historys;
    }

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return mixed
     *
     * @throws HistoryNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): HistoryInterface
    {
        /** @var HistoryInterface $history */
        $history = $this->findWrapped($id);

        if (null === $history) {
            throw new HistoryNotFoundException("Cannot find history with id $id");
        }

        return $history;
    }

    /**
     * @param string $id
     *
     * @return HistoryInterface
     *
     * @throws HistoryProxyException
     * @throws ORMException
     */
    public function proxy(string $id): HistoryInterface
    {
        $history = $this->referenceWrapped($id);

        if (!$this->containsWrapped($history)) {
            throw new HistoryProxyException("Proxy doesn't exist with $id");
        }

        return $history;
    }
}
