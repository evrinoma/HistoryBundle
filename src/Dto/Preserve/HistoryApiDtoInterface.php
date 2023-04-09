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

namespace Evrinoma\HistoryBundle\Dto\Preserve;

use Evrinoma\DtoCommon\ValueObject\Mutable\ActiveInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\BodyInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\PositionInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\StartAtInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\TitleInterface;
use Evrinoma\HistoryBundle\DtoCommon\ValueObject\Mutable\RangeApiDtoInterface;

interface HistoryApiDtoInterface extends IdInterface, ActiveInterface, PositionInterface, BodyInterface, TitleInterface, StartAtInterface, RangeApiDtoInterface
{
}
