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

namespace Evrinoma\HistoryBundle\Tests\Functional\ValueObject\History;

use Evrinoma\HistoryBundle\Model\FormatInterface;
use Evrinoma\TestUtilsBundle\ValueObject\Common\AbstractIdentity;

class FinishAt extends AbstractIdentity
{
    protected static string $value = '2023-04-06 17:21:50';
    protected static string $default = '2023-04-04 15:21:50';

    public static function default(): string
    {
        return (new \DateTimeImmutable(static::$default))->format(FormatInterface::FINISH_AT_FORMAT);
    }

    public static function value(): string
    {
        return (new \DateTimeImmutable(static::$value))->format(FormatInterface::FINISH_AT_FORMAT);
    }
}
