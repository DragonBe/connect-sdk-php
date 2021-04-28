<?php
declare(strict_types=1);

namespace OnePassword\ConnectTest\Model;

use OnePassword\Connect\Model\Vault;
use OnePassword\Connect\Model\VaultInterface;
use PHPUnit\Framework\TestCase;

class VaultTest extends TestCase
{
    /**
     * Test to verify Vault implements a Vault interface
     *
     * @covers \OnePassword\Connect\Model\Vault::__construct
     */
    public function testVaultImplementsVaultInterface(): void
    {
        $vault = new Vault();
        $this->assertInstanceOf(VaultInterface::class, $vault);
    }

    /**
     * Test that a Vault instance contains default values at creation
     *
     * @covers \OnePassword\Connect\Model\Vault::__construct
     * @covers \OnePassword\Connect\Model\Vault::getId
     * @covers \OnePassword\Connect\Model\Vault::getName
     * @covers \OnePassword\Connect\Model\Vault::getAttributeVersion
     * @covers \OnePassword\Connect\Model\Vault::getContentVersion
     * @covers \OnePassword\Connect\Model\Vault::getItems
     * @covers \OnePassword\Connect\Model\Vault::getType
     * @covers \OnePassword\Connect\Model\Vault::getCreatedAt
     * @covers \OnePassword\Connect\Model\Vault::getUpdatedAt
     */
    public function testVaultContainsDefaultValuesAtCreation(): void
    {
        $vault = new Vault();
        $this->assertSame('', $vault->getId());
        $this->assertSame('', $vault->getName());
        $this->assertSame(0, $vault->getAttributeVersion());
        $this->assertSame(0, $vault->getContentVersion());
        $this->assertSame(0, $vault->getItems());
        $this->assertSame('', $vault->getType());
        $this->assertSame('', $vault->getCreatedAt());
        $this->assertSame('', $vault->getUpdatedAt());
    }

    /**
     * @return array[]
     */
    public function vaultDataProvider(): array
    {
        return [
            'vault example data set' => [
                'id' => 'ytrfte14kw1uex5txaore1emkz',
                'name' => 'Demo',
                'attributeVersion' => 1,
                'contentVersion' => 72,
                'items' => 7,
                'type' => 'USER_CREATED',
                'createdAt' => '2021-04-10T17:34:26Z',
                'updatedAt' => '2021-04-13T14:33:50Z'
            ],
        ];
    }

    /**
     * Test that a Vault instance can set values at creation
     *
     * @param string $id
     * @param string $name
     * @param string $type
     * @param int $attributeVersion
     * @param int $contentVersion
     * @param int $items
     * @param string $createdAt
     * @param string $updatedAt
     *
     * @covers \OnePassword\Connect\Model\Vault::__construct
     * @covers \OnePassword\Connect\Model\Vault::getId
     * @covers \OnePassword\Connect\Model\Vault::getName
     * @covers \OnePassword\Connect\Model\Vault::getAttributeVersion
     * @covers \OnePassword\Connect\Model\Vault::getContentVersion
     * @covers \OnePassword\Connect\Model\Vault::getItems
     * @covers \OnePassword\Connect\Model\Vault::getType
     * @covers \OnePassword\Connect\Model\Vault::getCreatedAt
     * @covers \OnePassword\Connect\Model\Vault::getUpdatedAt
     *
     * @dataProvider vaultDataProvider
     */
    public function testVaultCanSetValuesAtCreation(
        string $id,
        string $name,
        int $attributeVersion,
        int $contentVersion,
        int $items,
        string $type,
        string $createdAt,
        string $updatedAt
    ): void {

        $vault = new Vault(
            $id,
            $name,
            $attributeVersion,
            $contentVersion,
            $items,
            $type,
            $createdAt,
            $updatedAt
        );
        $this->assertSame($id, $vault->getId());
        $this->assertSame($name, $vault->getName());
        $this->assertSame($attributeVersion, $vault->getAttributeVersion());
        $this->assertSame($contentVersion, $vault->getContentVersion());
        $this->assertSame($items, $vault->getItems());
        $this->assertSame($type, $vault->getType());
        $this->assertSame($createdAt, $vault->getCreatedAt());
        $this->assertSame($updatedAt, $vault->getUpdatedAt());
    }
}
