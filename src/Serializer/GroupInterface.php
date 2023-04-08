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

namespace Evrinoma\HistoryBundle\Serializer;

interface GroupInterface
{
    public const API_POST_HISTORY = 'API_POST_HISTORY';
    public const API_PUT_HISTORY = 'API_PUT_HISTORY';
    public const API_GET_HISTORY = 'API_GET_HISTORY';
    public const API_CRITERIA_HISTORY = self::API_GET_HISTORY;
    public const APP_GET_BASIC_HISTORY = 'APP_GET_BASIC_HISTORY';
}
