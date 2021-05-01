<?php
declare(strict_types=1);

namespace OnePassword\Connect\Model;

use ArrayIterator;

class ItemHydrator extends AbstractReflectionHydrator
{
    private ?VaultHydrator $vaultHydrator;
    private ?VaultInterface $vaultPrototype;

    public function __construct(
        ?HydratorInterface $vaultHydrator = null,
        ?VaultInterface $vaultPrototype = null
    ) {
        $this->vaultHydrator = $vaultHydrator;
        $this->vaultPrototype = $vaultPrototype;
    }

    public function hydrate(object $object, array $data): object
    {
        if (array_key_exists('vault', $data)) {
            $data['vault'] = $this->vaultHydrator->hydrate($this->vaultPrototype, $data['vault']);
        }
        if (! array_key_exists('fields', $data)) {
            $data['fields'] = null;
        }
        if (array_key_exists('fields', $data)) {
            $data['fields'] = new ArrayIterator([]);
        }
        if (! array_key_exists('urls', $data)) {
            $data['urls'] = null;
        }
        if (array_key_exists('urls', $data)) {
            $data['urls'] = null;
        }
        return parent::hydrate($object, $data);
    }

    public function extract(object $object): array
    {
        return parent::extract($object);
    }
}
