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
use Evrinoma\HistoryBundle\Exception\HistoryCannotBeCreatedException;
use Evrinoma\HistoryBundle\Exception\HistoryCannotBeRemovedException;
use Evrinoma\HistoryBundle\Exception\HistoryCannotBeSavedException;
use Evrinoma\HistoryBundle\Model\History\HistoryInterface;

interface CommandMediatorInterface
{
    /**
     * @param HistoryApiDtoInterface $dto
     * @param HistoryInterface       $entity
     *
     * @return HistoryInterface
     *
     * @throws HistoryCannotBeSavedException
     */
    public function onUpdate(HistoryApiDtoInterface $dto, HistoryInterface $entity): HistoryInterface;

    /**
     * @param HistoryApiDtoInterface $dto
     * @param HistoryInterface       $entity
     *
     * @throws HistoryCannotBeRemovedException
     */
    public function onDelete(HistoryApiDtoInterface $dto, HistoryInterface $entity): void;

    /**
     * @param HistoryApiDtoInterface $dto
     * @param HistoryInterface       $entity
     *
     * @return HistoryInterface
     *
     * @throws HistoryCannotBeSavedException
     * @throws HistoryCannotBeCreatedException
     */
    public function onCreate(HistoryApiDtoInterface $dto, HistoryInterface $entity): HistoryInterface;
}
