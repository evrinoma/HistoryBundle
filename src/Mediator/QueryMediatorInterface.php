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

namespace Evrinoma\HistoryBundle\Mediator;

use Evrinoma\HistoryBundle\Dto\HistoryApiDtoInterface;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

interface QueryMediatorInterface
{
    /**
     * @return string
     */
    public function alias(): string;

    /**
     * @param HistoryApiDtoInterface $dto
     * @param QueryBuilderInterface  $builder
     *
     * @return mixed
     */
    public function createQuery(HistoryApiDtoInterface $dto, QueryBuilderInterface $builder): void;

    /**
     * @param HistoryApiDtoInterface $dto
     * @param QueryBuilderInterface  $builder
     *
     * @return array
     */
    public function getResult(HistoryApiDtoInterface $dto, QueryBuilderInterface $builder): array;
}
