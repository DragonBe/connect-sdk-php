<?php
declare(strict_types=1);

namespace OnePassword\ConnectTest\Model;

use Iterator;
use OnePassword\Connect\Model\Item;
use OnePassword\Connect\Model\ItemInterface;
use OnePassword\Connect\Model\VaultInterface;
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
     * @covers \OnePassword\Connect\Model\Item::getSections
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
        $this->assertSame([], $item->getSections());
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

    public function itemDataProvider(): array
    {
        return [
            'Simple vault items' => [
                'id' => '19f88593fe4f4131bdd529fca609f1e2',
                'title' => 'Test vault item',
                'vault' => null,
                'category' => 'TEST',
                'sections' => [],
                'fields' => null,
                'urls' => null,
                'favorite' => true,
                'tags' => ['test'],
                'version' => 1,
                'trashend' => false,
                'createdAt' => '2021-04-10T17:20:05.98944527Z',
                'updatedAt' => '2021-04-10T17:20:05.989445411Z',
                'lastEditedBy' => '5864b141597c40a1b6154f4b5a9c6860',
            ],
        ];
    }

    /**
     * @param string $id
     * @param string $title
     * @param VaultInterface|null $vault
     * @param string $category
     * @param array $sections
     * @param Iterator|null $fields
     * @param Iterator|null $urls
     * @param bool $favourite
     * @param array $tags
     * @param int $version
     * @param bool $trashed
     * @param string $createdAt
     * @param string $updatedAt
     * @param string $lastEditedBy
     *
     * @covers \OnePassword\Connect\Model\Item::__construct
     * @covers \OnePassword\Connect\Model\Item::getId
     * @covers \OnePassword\Connect\Model\Item::getTitle
     * @covers \OnePassword\Connect\Model\Item::getVault
     * @covers \OnePassword\Connect\Model\Item::getCategory
     * @covers \OnePassword\Connect\Model\Item::getSections
     * @covers \OnePassword\Connect\Model\Item::getFields
     * @covers \OnePassword\Connect\Model\Item::getUrls
     * @covers \OnePassword\Connect\Model\Item::isFavourite
     * @covers \OnePassword\Connect\Model\Item::getTags
     * @covers \OnePassword\Connect\Model\Item::getVersion
     * @covers \OnePassword\Connect\Model\Item::isTrashed
     * @covers \OnePassword\Connect\Model\Item::getCreatedAt
     * @covers \OnePassword\Connect\Model\Item::getUpdatedAt
     * @covers \OnePassword\Connect\Model\Item::getLastEditedBy
     * @dataProvider itemDataProvider
     */
    public function testItemCanBeSetWithValues(
        string $id,
        string $title,
        ?VaultInterface $vault,
        string $category,
        array $sections,
        ?Iterator $fields,
        ?Iterator $urls,
        bool $favourite,
        array $tags,
        int $version,
        bool $trashed,
        string $createdAt,
        string $updatedAt,
        string $lastEditedBy
    ): void {
        $item = new Item(
            $id,
            $title,
            $vault,
            $category,
            $sections,
            $fields,
            $urls,
            $favourite,
            $tags,
            $version,
            $trashed,
            $createdAt,
            $updatedAt,
            $lastEditedBy,
        );
        $this->assertInstanceOf(Item::class, $item);
        $this->assertSame($id, $item->getId());
        $this->assertSame($title, $item->getTitle());
        $this->assertSame($vault, $item->getVault());
        $this->assertSame($category, $item->getCategory());
        $this->assertSame($sections, $item->getSections());
        $this->assertSame($fields, $item->getFields());
        $this->assertSame($urls, $item->getUrls());
        $this->assertSame($favourite, $item->isFavourite());
        $this->assertSame($tags, $item->getTags());
        $this->assertSame($version, $item->getVersion());
        $this->assertSame($trashed, $item->isTrashed());
        $this->assertSame($createdAt, $item->getCreatedAt());
        $this->assertSame($updatedAt, $item->getUpdatedAt());
        $this->assertsame($lastEditedBy, $item->getLastEditedBy());
    }
}
