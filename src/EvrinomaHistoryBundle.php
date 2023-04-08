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

namespace Evrinoma\HistoryBundle;

use Evrinoma\HistoryBundle\DependencyInjection\Compiler\Constraint\Property\HistoryPass;
use Evrinoma\HistoryBundle\DependencyInjection\Compiler\DecoratorPass;
use Evrinoma\HistoryBundle\DependencyInjection\Compiler\MapEntityPass;
use Evrinoma\HistoryBundle\DependencyInjection\Compiler\ServicePass;
use Evrinoma\HistoryBundle\DependencyInjection\EvrinomaHistoryExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaHistoryBundle extends Bundle
{
    public const BUNDLE = 'history';

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container
            ->addCompilerPass(new MapEntityPass($this->getNamespace(), $this->getPath()))
            ->addCompilerPass(new DecoratorPass())
            ->addCompilerPass(new ServicePass())
            ->addCompilerPass(new HistoryPass())
        ;
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaHistoryExtension();
        }

        return $this->extension;
    }
}
