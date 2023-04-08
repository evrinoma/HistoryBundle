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
use Evrinoma\DtoCommon\ValueObject\Mutable\ActiveTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\BodyTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\PositionTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\StartTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\TitleTrait;
use Symfony\Component\HttpFoundation\Request;

class HistoryApiDto extends AbstractDto implements HistoryApiDtoInterface
{
    use ActiveTrait;
    use IdTrait;
    use PositionTrait;
    use BodyTrait;
    use TitleTrait;
    use StartTrait;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $active = $request->get(HistoryApiDtoInterface::ACTIVE);
            $id = $request->get(HistoryApiDtoInterface::ID);
            $position = $request->get(HistoryApiDtoInterface::POSITION);
            $start = $request->get(HistoryApiDtoInterface::START);
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
            if ($start) {
                $this->setStart($start);
            }
        }

        return $this;
    }
}
