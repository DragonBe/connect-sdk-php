<?php
declare(strict_types=1);

namespace OnePassword\Connect;

use OnePassword\Connect\Model\HydratorInterface;
use OnePassword\Connect\Model\ItemInterface;
use OnePassword\Connect\Model\VaultInterface;
use Iterator;
use SplObjectStorage;
use function json_decode;

class OnePasswordConnect
{
    private AbstractOnePasswordClient $onePasswordClient;
    private HydratorInterface $vaultHydrator;
    private VaultInterface $vaultPrototype;
    private HydratorInterface $itemHydrator;
    private ItemInterface $itemPrototype;

    /**
     * OnePasswordConnect constructor.
     *
     * @param AbstractOnePasswordClient $onePasswordClient
     */
    public function __construct(
        AbstractOnePasswordClient $onePasswordClient,
        HydratorInterface $vaultHydrator,
        VaultInterface $vaultPrototype,
        HydratorInterface $itemHydrator,
        ItemInterface $itemPrototype
    ) {
        $this->onePasswordClient = $onePasswordClient;
        $this->vaultHydrator = $vaultHydrator;
        $this->vaultPrototype = $vaultPrototype;
        $this->itemHydrator = $itemHydrator;
        $this->itemPrototype = $itemPrototype;
    }

    public function listVaults(): Iterator
    {
        $vaults = new SplObjectStorage();
        $data = $this->extractData('GET', 'vaults');
        foreach ($data as $entry) {
            $vault = $this->vaultHydrator->hydrate($this->vaultPrototype, $entry);
            $vaults->attach($vault);
        }
        return $vaults;
    }

    public function getVault(string $vaultId): VaultInterface
    {
        $data = $this->extractData('GET', 'vaults/' . $vaultId);
        return $this->vaultHydrator->hydrate($this->vaultPrototype, $data);
    }

    public function listItems(string $vaultId): Iterator
    {
        $items = new SplObjectStorage();
        $data = $this->extractData('GET', 'vaults/' . $vaultId . '/items');
        foreach ($data as $entry) {
            $item = $this->itemHydrator->hydrate($this->itemPrototype, $entry);
            $items->attach($item);
        }
        return $items;
    }

    private function extractData(string $method, string $endPoint): array
    {
        $response = $this->onePasswordClient->prepareRequest($method, $endPoint);
        $jsonData = $response->getBody()->getContents();
        $data = json_decode($jsonData, true);
        if (false === $data) {
            return [];
        }
        return $data;
    }
}
