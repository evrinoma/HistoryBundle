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

use Evrinoma\HistoryBundle\Exception\HistoryCannotBeRemovedException;
use Evrinoma\HistoryBundle\Exception\HistoryCannotBeSavedException;
use Evrinoma\HistoryBundle\Model\History\HistoryInterface;

interface HistoryCommandRepositoryInterface
{
    /**
     * @param HistoryInterface $history
     *
     * @return bool
     *
     * @throws HistoryCannotBeSavedException
     */
    public function save(HistoryInterface $history): bool;

    /**
     * @param HistoryInterface $history
     *
     * @return bool
     *
     * @throws HistoryCannotBeRemovedException
     */
    public function remove(HistoryInterface $history): bool;
}
