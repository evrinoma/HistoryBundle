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

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\HistoryBundle\Dto\RangeApiDto;
use Evrinoma\HistoryBundle\Dto\RangeApiDtoInterface as BaseRangeApiDtoInterface;
use Symfony\Component\HttpFoundation\Request;

trait RangeApiDtoTrait
{
    protected ?BaseRangeApiDtoInterface $rangeApiDto = null;

    protected static string $classRangeApiDto = RangeApiDto::class;

    public function genRequestRangeApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $range = $request->get(RangeApiDtoInterface::RANGE);
            if ($range) {
                $newRequest = $this->getCloneRequest();
                $range[DtoInterface::DTO_CLASS] = static::$classRangeApiDto;
                $newRequest->request->add($range);

                yield $newRequest;
            }
        }
    }

    public function hasRangeApiDto(): bool
    {
        return null !== $this->rangeApiDto;
    }

    public function getRangeApiDto(): BaseRangeApiDtoInterface
    {
        return $this->rangeApiDto;
    }
}
