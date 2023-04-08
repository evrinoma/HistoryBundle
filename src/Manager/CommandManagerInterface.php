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
use Evrinoma\HistoryBundle\Exception\HistoryCannotBeRemovedException;
use Evrinoma\HistoryBundle\Exception\HistoryInvalidException;
use Evrinoma\HistoryBundle\Exception\HistoryNotFoundException;
use Evrinoma\HistoryBundle\Model\History\HistoryInterface;

interface CommandManagerInterface
{
    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @return HistoryInterface
     *
     * @throws HistoryInvalidException
     */
    public function post(HistoryApiDtoInterface $dto): HistoryInterface;

    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @return HistoryInterface
     *
     * @throws HistoryInvalidException
     * @throws HistoryNotFoundException
     */
    public function put(HistoryApiDtoInterface $dto): HistoryInterface;

    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @throws HistoryCannotBeRemovedException
     * @throws HistoryNotFoundException
     */
    public function delete(HistoryApiDtoInterface $dto): void;
}
