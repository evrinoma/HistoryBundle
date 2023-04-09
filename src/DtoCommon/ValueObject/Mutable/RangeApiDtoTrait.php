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

namespace Evrinoma\HistoryBundle\DtoCommon\ValueObject\Mutable;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\HistoryBundle\Dto\RangeApiDtoInterface;
use Evrinoma\HistoryBundle\DtoCommon\ValueObject\Immutable\RangeApiDtoTrait as RangeApiDtoImmutableTrait;

trait RangeApiDtoTrait
{
    use RangeApiDtoImmutableTrait;

    /**
     * @param RangeApiDtoInterface $rangeApiDto
     *
     * @return DtoInterface
     */
    public function setRangeApiDto(RangeApiDtoInterface $rangeApiDto): DtoInterface
    {
        $this->rangeApiDto = $rangeApiDto;

        return $this;
    }
}
