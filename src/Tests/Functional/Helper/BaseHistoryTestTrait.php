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

namespace Evrinoma\HistoryBundle\Tests\Functional\Helper;

use Evrinoma\HistoryBundle\Dto\HistoryApiDtoInterface;
use Evrinoma\HistoryBundle\Dto\RangeApiDtoInterface;
use Evrinoma\HistoryBundle\Tests\Functional\ValueObject\History\FinishAt;
use Evrinoma\HistoryBundle\Tests\Functional\ValueObject\History\StartAt;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;

trait BaseHistoryTestTrait
{
    protected static function defaultRangeData(): array
    {
        return [
            HistoryApiDtoInterface::RANGE => [
                RangeApiDtoInterface::START_AT => StartAt::value(),
                RangeApiDtoInterface::FINISH_AT => FinishAt::value(),
            ],
        ];
    }

    protected function assertGet(string $id): array
    {
        $find = $this->get($id);
        $this->testResponseStatusOK();

        $this->checkResult($find);

        return $find;
    }

    protected function createHistory(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function createConstraintBlankBody(): array
    {
        $query = static::getDefault([HistoryApiDtoInterface::BODY => '']);

        return $this->post($query);
    }

    protected function createConstraintBlankTitle(): array
    {
        $query = static::getDefault([HistoryApiDtoInterface::TITLE => '']);

        return $this->post($query);
    }

    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $entity);
        Assert::assertCount(1, $entity[PayloadModel::PAYLOAD]);
        $this->checkHistory($entity[PayloadModel::PAYLOAD][0]);
    }

    protected function checkHistory($entity): void
    {
        Assert::assertArrayHasKey(HistoryApiDtoInterface::ID, $entity);
        Assert::assertArrayHasKey(HistoryApiDtoInterface::BODY, $entity);
        Assert::assertArrayHasKey(HistoryApiDtoInterface::TITLE, $entity);
        Assert::assertArrayHasKey(HistoryApiDtoInterface::ACTIVE, $entity);
        Assert::assertArrayHasKey(HistoryApiDtoInterface::POSITION, $entity);
    }
}
