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

namespace Evrinoma\HistoryBundle\Mediator\Orm;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\HistoryBundle\Dto\HistoryApiDtoInterface;
use Evrinoma\HistoryBundle\Mediator\QueryMediatorInterface;
use Evrinoma\HistoryBundle\Model\FormatInterface;
use Evrinoma\HistoryBundle\Repository\AliasInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractQueryMediator;
use Evrinoma\UtilsBundle\Mediator\Orm\QueryMediatorTrait;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

class QueryMediator extends AbstractQueryMediator implements QueryMediatorInterface
{
    use QueryMediatorTrait;

    protected static string $alias = AliasInterface::HISTORY;

    /**
     * @param DtoInterface          $dto
     * @param QueryBuilderInterface $builder
     *
     * @return mixed
     */
    public function createQuery(DtoInterface $dto, QueryBuilderInterface $builder): void
    {
        $alias = $this->alias();

        /** @var $dto HistoryApiDtoInterface */
        if ($dto->hasId()) {
            $builder
                ->andWhere($alias.'.id = :id')
                ->setParameter('id', $dto->getId());
        }

        if ($dto->hasBody()) {
            $builder
                ->andWhere($alias.'.body like :body')
                ->setParameter('body', '%'.$dto->getBody().'%');
        }

        if ($dto->hasTitle()) {
            $builder
                ->andWhere($alias.'.title like :title')
                ->setParameter('title', '%'.$dto->getTitle().'%');
        }

        if ($dto->hasPosition()) {
            $builder
                ->andWhere($alias.'.position = :position')
                ->setParameter('position', $dto->getPosition());
        }

        if ($dto->hasActive()) {
            $builder
                ->andWhere($alias.'.active = :active')
                ->setParameter('active', $dto->getActive());
        }

        if ($dto->hasRangeApiDto()) {
            $dtoRange = $dto->getRangeApiDto();
            if ($dtoRange->hasStartAt()) {
                $startAt = (new \DateTimeImmutable($dtoRange->getStartAt()))->format(FormatInterface::START_AT_FORMAT);
                $builder
                    ->andWhere($alias.'.startAt >= :startAt')
                    ->setParameter('startAt', $startAt);
            }
            if ($dtoRange->hasFinishAt()) {
                $finishAt = (new \DateTimeImmutable($dtoRange->getFinishAt()))->format(FormatInterface::FINISH_AT_FORMAT);
                $builder
                    ->andWhere($alias.'.finishAt <= :finishAt')
                    ->setParameter('finishAt', $finishAt);
            }
        }
    }
}
