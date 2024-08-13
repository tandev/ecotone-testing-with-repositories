<?php

namespace App;

use Ecotone\Modelling\Attribute\Aggregate;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\EventHandler;
use Ecotone\Modelling\Attribute\Identifier;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\WithEvents;

#[Aggregate]
class FooAggregate
{
    use WithEvents;
    public function __construct(
        #[Identifier]
        public readonly string $identifier
    ) {
    }

    #[CommandHandler()]
    public static function create(CreateFooCommand $command, FooRepository $fooRepository): self
    {
        $foo = new FooAggregate('foobar');
        $foo->recordThat(new FooCreatedEvent($foo->identifier));

        return $foo;
    }

    #[EventHandler]
    public function activateFooWhenFooWasCreated(FooCreatedEvent $fooCreatedEvent, CommandBus $commandBus): void
    {
        $commandBus->send(new ActivateFooCommand($fooCreatedEvent->identifier));
    }

    #[CommandHandler()]
    public function activate(ActivateFooCommand $command, FooRepository $fooRepository): void
    {

    }
}
