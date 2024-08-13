<?php

namespace tests;

use App\CreateFooCommand;
use App\FooAggregate;
use App\FooRepository;
use Ecotone\Lite\EcotoneLite;
use PHPUnit\Framework\TestCase;

class CreateFooTest extends TestCase
{
    public function test_unit(): void
    {
        $this->doesNotPerformAssertions();

        $fooRepository = new FooRepository();
        FooAggregate::create(new CreateFooCommand(), $fooRepository);

        // cant test repository containing the object
    }

    public function test_using_custom_repository(): void
    {
        EcotoneLite::bootstrapFlowTesting(
            [FooAggregate::class],
            [FooRepository::class => $fooRepository = new FooRepository()],
            addInMemoryStateStoredRepository: false,
            addInMemoryEventSourcedRepository: false
        )->sendCommand(new CreateFooCommand())
        ;

        //fails, the object is not saved to repository
        self::assertNotEmpty($fooRepository->findAll());
    }

    public function test_using_default_repository(): void
    {
        EcotoneLite::bootstrapFlowTesting(
            [FooAggregate::class],
            [FooRepository::class => $fooRepository = new FooRepository()]
        )->sendCommand(new CreateFooCommand())
        ;

        //fails, the object is not saved to repository
        self::assertNotEmpty($fooRepository->findAll());

        //how to check the default repository?
    }
}
