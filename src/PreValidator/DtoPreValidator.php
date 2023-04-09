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

namespace Evrinoma\HistoryBundle\PreValidator;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\HistoryBundle\Dto\HistoryApiDtoInterface;
use Evrinoma\HistoryBundle\Exception\HistoryInvalidException;
use Evrinoma\UtilsBundle\PreValidator\AbstractPreValidator;

class DtoPreValidator extends AbstractPreValidator implements DtoPreValidatorInterface
{
    public function onPost(DtoInterface $dto): void
    {
        $this
            ->checkTitle($dto)
            ->checkBody($dto)
            ->checkStartAt($dto)
            ->checkPosition($dto);
    }

    public function onPut(DtoInterface $dto): void
    {
        $this
            ->checkId($dto)
            ->checkTitle($dto)
            ->checkBody($dto)
            ->checkActive($dto)
            ->checkStartAt($dto)
            ->checkPosition($dto);
    }

    public function onDelete(DtoInterface $dto): void
    {
        $this->checkId($dto);
    }

    private function checkStartAt(DtoInterface $dto): self
    {
        /** @var HistoryApiDtoInterface $dto */
        if (!$dto->hasStartAt()) {
            throw new HistoryInvalidException('The Dto has\'t start at');
        }

        return $this;
    }

    private function checkPosition(DtoInterface $dto): self
    {
        /** @var HistoryApiDtoInterface $dto */
        if (!$dto->hasPosition()) {
            throw new HistoryInvalidException('The Dto has\'t position');
        }

        return $this;
    }

    private function checkTitle(DtoInterface $dto): self
    {
        /** @var HistoryApiDtoInterface $dto */
        if (!$dto->hasTitle()) {
            throw new HistoryInvalidException('The Dto has\'t title');
        }

        return $this;
    }

    private function checkBody(DtoInterface $dto): self
    {
        /** @var HistoryApiDtoInterface $dto */
        if (!$dto->hasBody()) {
            throw new HistoryInvalidException('The Dto has\'t body');
        }

        return $this;
    }

    private function checkActive(DtoInterface $dto): self
    {
        /** @var HistoryApiDtoInterface $dto */
        if (!$dto->hasActive()) {
            throw new HistoryInvalidException('The Dto has\'t active');
        }

        return $this;
    }

    private function checkId(DtoInterface $dto): self
    {
        /** @var HistoryApiDtoInterface $dto */
        if (!$dto->hasId()) {
            throw new HistoryInvalidException('The Dto has\'t ID or class invalid');
        }

        return $this;
    }
}
