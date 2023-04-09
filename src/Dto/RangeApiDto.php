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

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\FinishAtTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\StartAtTrait;
use Symfony\Component\HttpFoundation\Request;

class RangeApiDto extends AbstractDto implements RangeApiDtoInterface
{
    use FinishAtTrait;
    use StartAtTrait;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $startAt = $request->get(RangeApiDtoInterface::START_AT);
            $finishAt = $request->get(RangeApiDtoInterface::FINISH_AT);
            if ($startAt && preg_match("/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/", $startAt)) {
                $this->setStartAt($startAt);
            }
            if ($finishAt && preg_match("/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/", $finishAt)) {
                $this->setFinishAt($finishAt);
            }
        }

        return $this;
    }
}
