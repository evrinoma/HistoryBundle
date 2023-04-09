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

namespace Evrinoma\HistoryBundle\Tests\Functional\Action;

use Evrinoma\HistoryBundle\Dto\HistoryApiDto;
use Evrinoma\HistoryBundle\Dto\HistoryApiDtoInterface;
use Evrinoma\HistoryBundle\Dto\RangeApiDtoInterface;
use Evrinoma\HistoryBundle\Tests\Functional\Helper\BaseHistoryTestTrait;
use Evrinoma\HistoryBundle\Tests\Functional\ValueObject\History\Active;
use Evrinoma\HistoryBundle\Tests\Functional\ValueObject\History\Body;
use Evrinoma\HistoryBundle\Tests\Functional\ValueObject\History\FinishAt;
use Evrinoma\HistoryBundle\Tests\Functional\ValueObject\History\Id;
use Evrinoma\HistoryBundle\Tests\Functional\ValueObject\History\Position;
use Evrinoma\HistoryBundle\Tests\Functional\ValueObject\History\StartAt;
use Evrinoma\HistoryBundle\Tests\Functional\ValueObject\History\Title;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\UtilsBundle\Model\ActiveModel;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;

class BaseHistory extends AbstractServiceTest implements BaseHistoryTestInterface
{
    use BaseHistoryTestTrait;

    public const API_GET = 'evrinoma/api/history';
    public const API_CRITERIA = 'evrinoma/api/history/criteria';
    public const API_DELETE = 'evrinoma/api/history/delete';
    public const API_PUT = 'evrinoma/api/history/save';
    public const API_POST = 'evrinoma/api/history/create';

    protected static function getDtoClass(): string
    {
        return HistoryApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            HistoryApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            HistoryApiDtoInterface::ID => Id::default(),
            HistoryApiDtoInterface::BODY => Body::default(),
            HistoryApiDtoInterface::ACTIVE => Active::value(),
            HistoryApiDtoInterface::TITLE => Title::default(),
            HistoryApiDtoInterface::POSITION => Position::value(),
            HistoryApiDtoInterface::START_AT => StartAt::value(),
        ];
    }

    public function actionPost(): void
    {
        $this->createHistory();
        $this->testResponseStatusCreated();
    }

    public function actionCriteriaNotFound(): void
    {
        $find = $this->criteria([
            HistoryApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            HistoryApiDtoInterface::ACTIVE => Active::wrong(),
        ]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);

        $find = $this->criteria([
            HistoryApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            HistoryApiDtoInterface::ID => Id::value(),
            HistoryApiDtoInterface::ACTIVE => Active::block(),
            HistoryApiDtoInterface::BODY => Body::wrong(),
        ]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);
    }

    public function actionCriteria(): void
    {
        $range = static::defaultRangeData();
        $data = array_merge(
            [
                HistoryApiDtoInterface::DTO_CLASS => static::getDtoClass(),
                HistoryApiDtoInterface::ACTIVE => Active::nullable(),
                HistoryApiDtoInterface::ID => Id::nullable(),
            ],
            $range);
        $find = $this->criteria($data);
        $this->testResponseStatusOK();
        Assert::assertCount(7, $find[PayloadModel::PAYLOAD]);

        $range = static::defaultRangeData();
        unset($range[HistoryApiDtoInterface::RANGE][RangeApiDtoInterface::FINISH_AT]);
        $range[HistoryApiDtoInterface::RANGE][RangeApiDtoInterface::START_AT] = StartAt::default();
        $data = array_merge(
            [
                HistoryApiDtoInterface::DTO_CLASS => static::getDtoClass(),
                HistoryApiDtoInterface::ACTIVE => Active::nullable(),
                HistoryApiDtoInterface::ID => Id::nullable(),
            ],
            $range);
        $find = $this->criteria($data);
        $this->testResponseStatusOK();
        Assert::assertCount(3, $find[PayloadModel::PAYLOAD]);

        $range = static::defaultRangeData();
        unset($range[HistoryApiDtoInterface::RANGE][RangeApiDtoInterface::START_AT]);
        $range[HistoryApiDtoInterface::RANGE][RangeApiDtoInterface::FINISH_AT] = FinishAt::default();
        $data = array_merge(
            [
                HistoryApiDtoInterface::DTO_CLASS => static::getDtoClass(),
                HistoryApiDtoInterface::ACTIVE => Active::nullable(),
                HistoryApiDtoInterface::ID => Id::nullable(),
            ],
            $range);
        $find = $this->criteria($data);
        $this->testResponseStatusOK();
        Assert::assertCount(5, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([
            HistoryApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            HistoryApiDtoInterface::ACTIVE => Active::value(),
            HistoryApiDtoInterface::ID => Id::value(),
        ]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([
            HistoryApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            HistoryApiDtoInterface::ACTIVE => Active::delete(),
        ]);
        $this->testResponseStatusOK();
        Assert::assertCount(3, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([
            HistoryApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            HistoryApiDtoInterface::ACTIVE => Active::delete(),
            HistoryApiDtoInterface::BODY => Body::value(),
        ]);
        $this->testResponseStatusOK();
        Assert::assertCount(2, $find[PayloadModel::PAYLOAD]);
    }

    public function actionDelete(): void
    {
        $find = $this->assertGet(Id::value());

        Assert::assertEquals(ActiveModel::ACTIVE, $find[PayloadModel::PAYLOAD][0][HistoryApiDtoInterface::ACTIVE]);

        $this->delete(Id::value());
        $this->testResponseStatusAccepted();

        $delete = $this->assertGet(Id::value());

        Assert::assertEquals(ActiveModel::DELETED, $delete[PayloadModel::PAYLOAD][0][HistoryApiDtoInterface::ACTIVE]);
    }

    public function actionPut(): void
    {
        $find = $this->assertGet(Id::value());

        $updated = $this->put(static::getDefault([
            HistoryApiDtoInterface::ID => Id::value(),
            HistoryApiDtoInterface::BODY => Body::value(),
            HistoryApiDtoInterface::TITLE => Title::value(),
            HistoryApiDtoInterface::POSITION => Position::value(),
            HistoryApiDtoInterface::START_AT => StartAt::value(),
        ]));
        $this->testResponseStatusOK();
        Assert::assertEquals($find[PayloadModel::PAYLOAD][0][HistoryApiDtoInterface::ID], $updated[PayloadModel::PAYLOAD][0][HistoryApiDtoInterface::ID]);
        Assert::assertEquals(Body::value(), $updated[PayloadModel::PAYLOAD][0][HistoryApiDtoInterface::BODY]);
        Assert::assertEquals(Title::value(), $updated[PayloadModel::PAYLOAD][0][HistoryApiDtoInterface::TITLE]);
        Assert::assertEquals(Position::value(), $updated[PayloadModel::PAYLOAD][0][HistoryApiDtoInterface::POSITION]);
        Assert::assertEquals(StartAt::value(), $updated[PayloadModel::PAYLOAD][0][HistoryApiDtoInterface::START_AT]);
    }

    public function actionGet(): void
    {
        $find = $this->assertGet(Id::value());
    }

    public function actionGetNotFound(): void
    {
        $response = $this->get(Id::wrong());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteNotFound(): void
    {
        $response = $this->delete(Id::wrong());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteUnprocessable(): void
    {
        $response = $this->delete(Id::blank());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPutNotFound(): void
    {
        $this->put(static::getDefault([
            HistoryApiDtoInterface::ID => Id::wrong(),
            HistoryApiDtoInterface::BODY => Body::wrong(),
            HistoryApiDtoInterface::TITLE => Title::wrong(),
            HistoryApiDtoInterface::POSITION => Position::wrong(),
            HistoryApiDtoInterface::START_AT => StartAt::value(),
        ]));
        $this->testResponseStatusNotFound();
    }

    public function actionPutUnprocessable(): void
    {
        $created = $this->createHistory();
        $this->testResponseStatusCreated();
        $this->checkResult($created);

        $query = static::getDefault([
            HistoryApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][HistoryApiDtoInterface::ID],
            HistoryApiDtoInterface::BODY => Body::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault([
            HistoryApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][HistoryApiDtoInterface::ID],
            HistoryApiDtoInterface::TITLE => Title::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault([
            HistoryApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][HistoryApiDtoInterface::ID],
            HistoryApiDtoInterface::POSITION => Position::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPostDuplicate(): void
    {
        $this->createHistory();
        $this->testResponseStatusCreated();
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPostUnprocessable(): void
    {
        $this->postWrong();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankBody();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankTitle();
        $this->testResponseStatusUnprocessable();
    }
}
