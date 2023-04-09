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

namespace Evrinoma\HistoryBundle\DtoCommon\ValueObject\Immutable;

use Evrinoma\HistoryBundle\Dto\RangeApiDtoInterface as BaseRangeApiDtoInterface;

interface RangeApiDtoInterface
{
    public const RANGE = BaseRangeApiDtoInterface::RANGE;

    public function hasRangeApiDto(): bool;

    public function getRangeApiDto(): BaseRangeApiDtoInterface;
}
