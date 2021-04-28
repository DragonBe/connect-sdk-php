<?php
declare(strict_types=1);

namespace OnePassword\ConnectTest;

use Iterator;
use OnePassword\Connect\AbstractOnePasswordClient;
use OnePassword\Connect\Model\Vault;
use OnePassword\Connect\Model\VaultHydrator;
use OnePassword\Connect\Model\VaultInterface;
use OnePassword\Connect\OnePasswordConnect;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class OnePasswordConnectTest extends TestCase
{
    /**
     * Test to see we can list vaults
     *
     * @covers \OnePassword\Connect\OnePasswordConnect::__construct
     * @covers \OnePassword\Connect\OnePasswordConnect::listVaults
     * @covers \OnePassword\Connect\OnePasswordConnect::extractData
     * @covers \OnePassword\Connect\Model\Vault::__construct
     * @covers \OnePassword\Connect\Model\VaultHydrator::hydrate
     */
    public function testConnectorCanListVaults(): void
    {
        $client = $this->createStubClient('vault_collection.json');
        $vaultHydrator = new VaultHydrator();
        $vaultPrototype = new Vault();
        $onePasswordConnect = new OnePasswordConnect($client, $vaultHydrator, $vaultPrototype);
        $vaults = $onePasswordConnect->listVaults();
        $this->assertInstanceOf(Iterator::class, $vaults);
        $this->assertSame(3, \iterator_count($vaults));
        $vaults->rewind();
        $this->assertInstanceOf(VaultInterface::class, $vaults->current());
    }

    /**
     * Test to see we can list vaults
     *
     * @covers \OnePassword\Connect\OnePasswordConnect::__construct
     * @covers \OnePassword\Connect\OnePasswordConnect::getVault
     * @covers \OnePassword\Connect\OnePasswordConnect::extractData
     * @covers \OnePassword\Connect\Model\Vault::__construct
     * @covers \OnePassword\Connect\Model\Vault::getId
     * @covers \OnePassword\Connect\Model\VaultHydrator::hydrate
     */
    public function testConnectorCanRetrieveSingleVault(): void
    {
        $vaultId = 'ytrfte14kw1uex5txaore1emkz';
        $client = $this->createStubClient('vault.json');
        $vaultHydrator = new VaultHydrator();
        $vaultPrototype = new Vault();
        $onePasswordConnect = new OnePasswordConnect($client, $vaultHydrator, $vaultPrototype);
        $vault = $onePasswordConnect->getVault($vaultId);
        $this->assertInstanceOf(VaultInterface::class, $vault);
        $this->assertSame($vaultId, $vault->getId());
    }

    private function createStubClient($fixture): AbstractOnePasswordClient
    {
        $client = $this->createStub(AbstractOnePasswordClient::class);
        $response = $this->createStub(ResponseInterface::class);
        $body = $this->createStub(StreamInterface::class);
        $body->method('getContents')
            ->willReturn(\file_get_contents(__DIR__ . '/_files/' . $fixture));
        $response->method('getBody')->willReturn($body);
        $client->method('prepareRequest')->willReturn($response);
        return $client;
    }
}
