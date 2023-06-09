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

namespace Evrinoma\HistoryBundle\DependencyInjection\Compiler;

use Evrinoma\HistoryBundle\DependencyInjection\EvrinomaHistoryExtension;
use Evrinoma\HistoryBundle\Model\History\HistoryInterface;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractMapEntity;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MapEntityPass extends AbstractMapEntity implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ('orm' === $container->getParameter('evrinoma.history.storage')) {
            $this->setContainer($container);

            $driver = $container->findDefinition('doctrine.orm.default_metadata_driver');
            $referenceAnnotationReader = new Reference('annotations.reader');

            $this->cleanMetadata($driver, [EvrinomaHistoryExtension::ENTITY]);

            $entityHistory = $container->getParameter('evrinoma.history.entity');
            if (str_contains($entityHistory, EvrinomaHistoryExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/History', '%s/Entity/History');
            }
            $this->addResolveTargetEntity([$entityHistory => [HistoryInterface::class => []]], false);
        }
    }
}
