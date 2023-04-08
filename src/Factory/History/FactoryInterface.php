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

namespace Evrinoma\HistoryBundle\Factory\History;

use Evrinoma\HistoryBundle\Dto\HistoryApiDtoInterface;
use Evrinoma\HistoryBundle\Model\History\HistoryInterface;

interface FactoryInterface
{
    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @return HistoryInterface
     */
    public function create(HistoryApiDtoInterface $dto): HistoryInterface;
}
