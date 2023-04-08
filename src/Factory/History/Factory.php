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

namespace Evrinoma\HistoryBundle\Factory\History;

use Evrinoma\HistoryBundle\Dto\HistoryApiDtoInterface;
use Evrinoma\HistoryBundle\Entity\History\BaseHistory;
use Evrinoma\HistoryBundle\Model\History\HistoryInterface;

class Factory implements FactoryInterface
{
    private static string $entityClass = BaseHistory::class;

    public function __construct(string $entityClass)
    {
        self::$entityClass = $entityClass;
    }

    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @return HistoryInterface
     */
    public function create(HistoryApiDtoInterface $dto): HistoryInterface
    {
        /* @var BaseHistory $history */
        return new self::$entityClass();
    }
}
