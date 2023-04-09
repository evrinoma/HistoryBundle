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

use Evrinoma\TestUtilsBundle\ValueObject\Common\AbstractIdentity;

class StartAt extends AbstractIdentity
{
    protected static string $value = '08-04-2023 13:13:13';
    protected static string $default = '07-04-2023';

    public static function default(): string
    {
        return (new \DateTimeImmutable(static::$default))->format('Y-m-d H:i:s');
    }

    public static function value(): string
    {
        return (new \DateTimeImmutable(static::$value))->format('Y-m-d H:i:s');
    }
}
