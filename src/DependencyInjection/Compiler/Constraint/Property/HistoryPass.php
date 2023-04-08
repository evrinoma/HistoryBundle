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

namespace Evrinoma\HistoryBundle\DependencyInjection\Compiler\Constraint\Property;

use Evrinoma\HistoryBundle\Validator\HistoryValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class HistoryPass extends AbstractConstraint implements CompilerPassInterface
{
    public const HISTORY_CONSTRAINT = 'evrinoma.history.constraint.property';

    protected static string $alias = self::HISTORY_CONSTRAINT;
    protected static string $class = HistoryValidator::class;
    protected static string $methodCall = 'addPropertyConstraint';
}
