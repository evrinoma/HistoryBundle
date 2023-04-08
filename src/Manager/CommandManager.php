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

namespace Evrinoma\HistoryBundle\Manager;

use Evrinoma\HistoryBundle\Dto\HistoryApiDtoInterface;
use Evrinoma\HistoryBundle\Exception\HistoryCannotBeCreatedException;
use Evrinoma\HistoryBundle\Exception\HistoryCannotBeRemovedException;
use Evrinoma\HistoryBundle\Exception\HistoryCannotBeSavedException;
use Evrinoma\HistoryBundle\Exception\HistoryInvalidException;
use Evrinoma\HistoryBundle\Exception\HistoryNotFoundException;
use Evrinoma\HistoryBundle\Factory\History\FactoryInterface;
use Evrinoma\HistoryBundle\Mediator\CommandMediatorInterface;
use Evrinoma\HistoryBundle\Model\History\HistoryInterface;
use Evrinoma\HistoryBundle\Repository\History\HistoryRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private HistoryRepositoryInterface $repository;
    private ValidatorInterface            $validator;
    private FactoryInterface           $factory;
    private CommandMediatorInterface      $mediator;

    /**
     * @param ValidatorInterface       $validator
     * @param HistoryRepositoryInterface  $repository
     * @param FactoryInterface         $factory
     * @param CommandMediatorInterface $mediator
     */
    public function __construct(ValidatorInterface $validator, HistoryRepositoryInterface $repository, FactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
    }

    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @return HistoryInterface
     *
     * @throws HistoryInvalidException
     * @throws HistoryCannotBeCreatedException
     * @throws HistoryCannotBeSavedException
     */
    public function post(HistoryApiDtoInterface $dto): HistoryInterface
    {
        $history = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $history);

        $errors = $this->validator->validate($history);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new HistoryInvalidException($errorsString);
        }

        $this->repository->save($history);

        return $history;
    }

    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @return HistoryInterface
     *
     * @throws HistoryInvalidException
     * @throws HistoryNotFoundException
     * @throws HistoryCannotBeSavedException
     */
    public function put(HistoryApiDtoInterface $dto): HistoryInterface
    {
        try {
            $history = $this->repository->find($dto->idToString());
        } catch (HistoryNotFoundException $e) {
            throw $e;
        }

        $this->mediator->onUpdate($dto, $history);

        $errors = $this->validator->validate($history);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new HistoryInvalidException($errorsString);
        }

        $this->repository->save($history);

        return $history;
    }

    /**
     * @param HistoryApiDtoInterface $dto
     *
     * @throws HistoryCannotBeRemovedException
     * @throws HistoryNotFoundException
     */
    public function delete(HistoryApiDtoInterface $dto): void
    {
        try {
            $history = $this->repository->find($dto->idToString());
        } catch (HistoryNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $history);
        try {
            $this->repository->remove($history);
        } catch (HistoryCannotBeRemovedException $e) {
            throw $e;
        }
    }
}
