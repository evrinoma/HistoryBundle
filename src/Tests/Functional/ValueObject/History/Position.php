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

use Evrinoma\TestUtilsBundle\ValueObject\Common\AbstractId;

class Position extends AbstractId
{
    protected static string $value = '1';
    protected static string $default = '2';

    public static function default(): string
    {
        return static::$default;
    }
}
