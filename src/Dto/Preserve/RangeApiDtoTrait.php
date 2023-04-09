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

namespace Evrinoma\HistoryBundle\Dto\Preserve;

use Evrinoma\DtoCommon\ValueObject\Preserve\FinishAtTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\StartAtTrait;

trait RangeApiDtoTrait
{
    use FinishAtTrait;
    use StartAtTrait;
}
