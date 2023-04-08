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

use Evrinoma\HistoryBundle\Dto\HistoryApiDtoInterface;
use Evrinoma\HistoryBundle\Exception\HistoryInvalidException;

interface DtoPreValidatorInterface
{
    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @throws HistoryInvalidException
     */
    public function onPost(HistoryApiDtoInterface $dto): void;

    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @throws HistoryInvalidException
     */
    public function onPut(HistoryApiDtoInterface $dto): void;

    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @throws HistoryInvalidException
     */
    public function onDelete(HistoryApiDtoInterface $dto): void;
}
