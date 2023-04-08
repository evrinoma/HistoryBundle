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

interface QueryManagerInterface
{
    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @return array
     *
     * @throws HistoryNotFoundException
     */
    public function criteria(HistoryApiDtoInterface $dto): array;

    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @return HistoryInterface
     *
     * @throws HistoryNotFoundException
     */
    public function get(HistoryApiDtoInterface $dto): HistoryInterface;

    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @return HistoryInterface
     *
     * @throws HistoryProxyException
     */
    public function proxy(HistoryApiDtoInterface $dto): HistoryInterface;
}
