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

use Evrinoma\DtoBundle\Annotation\Dto;
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\ActiveTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\BodyTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\PositionTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\StartAtTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\TitleTrait;
use Evrinoma\HistoryBundle\DtoCommon\ValueObject\Mutable\RangeApiDtoTrait;
use Symfony\Component\HttpFoundation\Request;

class HistoryApiDto extends AbstractDto implements HistoryApiDtoInterface
{
    use ActiveTrait;
    use BodyTrait;
    use IdTrait;
    use PositionTrait;
    use RangeApiDtoTrait;
    use StartAtTrait;
    use TitleTrait;

    /**
     * @Dto(class="Evrinoma\HistoryBundle\Dto\RangeApiDto", generator="genRequestRangeApiDto")
     *
     * @var RangeApiDtoInterface|null
     */
    protected ?RangeApiDtoInterface $rangeApiDto = null;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $active = $request->get(HistoryApiDtoInterface::ACTIVE);
            $id = $request->get(HistoryApiDtoInterface::ID);
            $position = $request->get(HistoryApiDtoInterface::POSITION);
            $startAt = $request->get(HistoryApiDtoInterface::START_AT);
            $title = $request->get(HistoryApiDtoInterface::TITLE);
            $body = $request->get(HistoryApiDtoInterface::BODY);

            if ($active) {
                $this->setActive($active);
            }
            if ($id) {
                $this->setId($id);
            }
            if ($position) {
                $this->setPosition($position);
            }
            if ($title) {
                $this->setTitle($title);
            }
            if ($body) {
                $this->setBody($body);
            }
            if ($startAt) {
                $this->setStartAt($startAt);
            }
        }

        return $this;
    }
}
