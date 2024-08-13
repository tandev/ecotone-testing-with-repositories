<?php

namespace App;

use Ecotone\Modelling\StandardRepository;

class FooRepository implements StandardRepository
{
    private array $storage = [];

    public function canHandle(string $aggregateClassName): bool
    {
        return $aggregateClassName === FooAggregate::class;
    }

    public function findBy(string $aggregateClassName, array $identifiers): ?object
    {
        $identifier = array_pop($identifiers);

        return $this->storage[$identifier] ?? null;
    }

    public function save(array $identifiers, object $aggregate, array $metadata, int|null $versionBeforeHandling): void
    {
        $identifier = array_pop($identifiers);
        $this->storage[(string) $identifier] = $aggregate;
    }

    public function findAll(): array
    {
        return $this->storage;
    }
}
