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

namespace Evrinoma\HistoryBundle\Fixtures;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Evrinoma\HistoryBundle\Dto\HistoryApiDtoInterface;
use Evrinoma\HistoryBundle\Entity\History\BaseHistory;
use Evrinoma\TestUtilsBundle\Fixtures\AbstractFixture;

class HistoryFixtures extends AbstractFixture implements FixtureGroupInterface, OrderedFixtureInterface
{
    protected static array $data = [
        [
            HistoryApiDtoInterface::TITLE => 'ite',
            HistoryApiDtoInterface::BODY => 'http://ite',
            HistoryApiDtoInterface::ACTIVE => 'a',
            HistoryApiDtoInterface::POSITION => 1,
            HistoryApiDtoInterface::START_AT => '2023-03-31 11:21:50',
            'created_at' => '2008-10-23 10:21:50',
        ],
        [
            HistoryApiDtoInterface::TITLE => 'kzkt',
            HistoryApiDtoInterface::BODY => 'http://kzkt',
            HistoryApiDtoInterface::ACTIVE => 'a',
            HistoryApiDtoInterface::POSITION => 2,
            HistoryApiDtoInterface::START_AT => '2023-04-01 12:21:50',
            'created_at' => '2015-10-23 10:21:50',
        ],
        [
            HistoryApiDtoInterface::TITLE => 'c2m',
            HistoryApiDtoInterface::BODY => 'http://c2m',
            HistoryApiDtoInterface::ACTIVE => 'a',
            HistoryApiDtoInterface::POSITION => 3,
            HistoryApiDtoInterface::START_AT => '2023-04-02 13:21:50',
            'created_at' => '2020-10-23 10:21:50',
        ],
        [
            HistoryApiDtoInterface::TITLE => 'kzkt2',
            HistoryApiDtoInterface::BODY => 'http://kzkt2',
            HistoryApiDtoInterface::ACTIVE => 'd',
            HistoryApiDtoInterface::POSITION => 1,
            HistoryApiDtoInterface::START_AT => '2023-04-03 14:21:50',
            'created_at' => '2015-10-23 10:21:50',
            ],
        [
            HistoryApiDtoInterface::TITLE => 'nvr',
            HistoryApiDtoInterface::BODY => 'http://nvr',
            HistoryApiDtoInterface::ACTIVE => 'b',
            HistoryApiDtoInterface::POSITION => 2,
            HistoryApiDtoInterface::START_AT => '2023-04-04 15:21:50',
            'created_at' => '2010-10-23 10:21:50',
        ],
        [
            HistoryApiDtoInterface::TITLE => 'nvr2',
            HistoryApiDtoInterface::BODY => 'http://nvr2',
            HistoryApiDtoInterface::ACTIVE => 'd',
            HistoryApiDtoInterface::POSITION => 3,
            HistoryApiDtoInterface::START_AT => '2023-04-05 16:21:50',
            'created_at' => '2010-10-23 10:21:50',
            ],
        [
            HistoryApiDtoInterface::TITLE => 'nvr3',
            HistoryApiDtoInterface::BODY => 'http://nvr3',
            HistoryApiDtoInterface::ACTIVE => 'd',
            HistoryApiDtoInterface::POSITION => 1,
            HistoryApiDtoInterface::START_AT => '2023-04-06 17:21:50',
            'created_at' => '2011-10-23 10:21:50',
        ],
    ];

    protected static string $class = BaseHistory::class;

    /**
     * @param ObjectManager $manager
     *
     * @return $this
     *
     * @throws \Exception
     */
    protected function create(ObjectManager $manager): self
    {
        $short = static::getReferenceName();
        $i = 0;

        foreach ($this->getData() as $record) {
            $entity = $this->getEntity();
            $entity
                ->setStartAt(new \DateTimeImmutable($record[HistoryApiDtoInterface::START_AT]))
                ->setTitle($record[HistoryApiDtoInterface::TITLE])
                ->setBody($record[HistoryApiDtoInterface::BODY])
                ->setPosition($record[HistoryApiDtoInterface::POSITION])
                ->setCreatedAt(new \DateTimeImmutable($record['created_at']))
                ->setActive($record[HistoryApiDtoInterface::ACTIVE]);

            $this->expandEntity($entity, $record);

            $this->addReference($short.$i, $entity);
            $manager->persist($entity);
            ++$i;
        }

        return $this;
    }

    public static function getGroups(): array
    {
        return [
            FixtureInterface::HISTORY_FIXTURES,
        ];
    }

    public function getOrder()
    {
        return 0;
    }
}
