<?php
declare(strict_types=1);

namespace OnePassword\ConnectTest\Model;

use OnePassword\Connect\Model\Item;
use OnePassword\Connect\Model\ItemHydrator;
use OnePassword\Connect\Model\ItemInterface;
use OnePassword\Connect\Model\Vault;
use OnePassword\Connect\Model\VaultHydrator;
use OnePassword\Connect\Model\VaultInterface;
use PHPUnit\Framework\TestCase;

class ItemHydratorTest extends TestCase
{
    /**
     * Testing we can hydrate data into an Item object
     *
     * @covers \OnePassword\Connect\Model\Item::__construct
     * @covers \OnePassword\Connect\Model\Item::getId
     * @covers \OnePassword\Connect\Model\Item::getTitle
     * @covers \OnePassword\Connect\Model\ItemHydrator::__construct
     * @covers \OnePassword\Connect\Model\ItemHydrator::hydrate
     * @covers \OnePassword\Connect\Model\AbstractReflectionHydrator::hydrate
     * @covers \OnePassword\Connect\Model\Vault::__construct
     * @covers \OnePassword\Connect\Model\Vault::hydrate
     */
    public function testItemHydration(): void
    {
        $itemPrototype = new Item();
        $data = [
            'id' => '2fcbqwe9ndg175zg2dzwftvkpa',
            'title' => 'Secrets Automation Item',
            'vault' => [
                'id' => 'ftz4pm2xxwmwrsd7rjqn7grzfz',
            ],
        ];
        $vaultHydrator = new VaultHydrator();
        $vaultPrototype = new Vault();
        $itemHydrator = new ItemHydrator($vaultHydrator, $vaultPrototype);
        $item = $itemHydrator->hydrate($itemPrototype, $data);
        $this->assertInstanceOf(ItemInterface::class, $item);
        $this->assertSame($data['id'], $item->getId());
        $this->assertSame($data['title'], $item->getTitle());
    }

    /**
     * @covers \OnePassword\Connect\Model\Item
     * @covers \OnePassword\Connect\Model\ItemHydrator::__construct
     * @covers \OnePassword\Connect\Model\ItemHydrator::extract
     * @covers \OnePassword\Connect\Model\AbstractReflectionHydrator::extract
     * @covers \OnePassword\Connect\Model\Vault::__construct
     * @covers \OnePassword\Connect\Model\VaultHydrator::hydrate
     */
    public function testItemCanExtractData(): void
    {
        $vaultItem = $this->createStub(VaultInterface::class);
        $item = new Item(
            'id',
            'test data',
            $vaultItem,
            'TEST',
            [],
            null,
            null,
            false,
            ['test'],
            1,
            false,
            '2021-04-10T17:20:05.98944527Z',
            '2021-04-13T17:20:05.989445411Z',
            '5864b141597c40a1b6154f4b5a9c6860'
        );
        $vaultHydrator = new VaultHydrator();
        $vaultPrototype = new Vault();
        $itemHydrator = new ItemHydrator($vaultHydrator, $vaultPrototype);
        $data = $itemHydrator->extract($item);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('id', $data);
        $this->assertSame('id', $data['id']);
        $this->assertArrayHasKey('title', $data);
        $this->assertSame('test data', $data['title']);
    }
}
