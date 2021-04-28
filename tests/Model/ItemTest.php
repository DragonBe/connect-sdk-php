<?php
declare(strict_types=1);

namespace OnePassword\ConnectTest\Model;

use OnePassword\Connect\Model\Item;
use OnePassword\Connect\Model\ItemInterface;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    /**
     * Test item implements item interface
     *
     * @covers \OnePassword\Connect\Model\Item::__construct
     */
    public function testItemImplementsItemInterface(): void
    {
        $item = new Item();
        $this->assertInstanceOf(ItemInterface::class, $item);
    }

    /**
     * Test item contains default values at creation
     *
     * @covers \OnePassword\Connect\Model\Item::__construct
     * @covers \OnePassword\Connect\Model\Item::getId
     * @covers \OnePassword\Connect\Model\Item::getTitle
     * @covers \OnePassword\Connect\Model\Item::getVault
     * @covers \OnePassword\Connect\Model\Item::getCategory
     * @covers \OnePassword\Connect\Model\Item::getFields
     * @covers \OnePassword\Connect\Model\Item::getUrls
     * @covers \OnePassword\Connect\Model\Item::isFavourite
     * @covers \OnePassword\Connect\Model\Item::getTags
     * @covers \OnePassword\Connect\Model\Item::getVersion
     * @covers \OnePassword\Connect\Model\Item::isTrashed
     * @covers \OnePassword\Connect\Model\Item::getCreatedAt
     * @covers \OnePassword\Connect\Model\Item::getUpdatedAt
     * @covers \OnePassword\Connect\Model\Item::getLastEditedBy
     */
    public function testItemContainsDefaultValuesAtCreation(): void
    {
        $item = new Item();
        $this->assertSame('', $item->getId());
        $this->assertSame('', $item->getTitle());
        $this->assertNull($item->getVault());
        $this->assertSame('', $item->getCategory());
        $this->assertNull($item->getFields());
        $this->assertNull($item->getUrls());
        $this->assertFalse($item->isFavourite());
        $this->assertSame([], $item->getTags());
        $this->assertSame(0, $item->getVersion());
        $this->assertFalse($item->isTrashed());
        $this->assertSame('', $item->getCreatedAt());
        $this->assertSame('', $item->getUpdatedAt());
        $this->assertSame('', $item->getLastEditedBy());
    }
}
