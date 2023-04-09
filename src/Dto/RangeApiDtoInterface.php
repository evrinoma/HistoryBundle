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

namespace Evrinoma\HistoryBundle\Dto;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\FinishAtInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\StartAtInterface;

interface RangeApiDtoInterface extends DtoInterface, StartAtInterface, FinishAtInterface
{
    public const RANGE = 'range';
}
