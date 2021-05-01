<?php
declare(strict_types=1);

namespace OnePassword\Connect;

use GuzzleHttp\Client;
use OnePassword\Connect\Model\Item;
use OnePassword\Connect\Model\ItemHydrator;
use OnePassword\Connect\Model\Vault;
use OnePassword\Connect\Model\VaultHydrator;

class OnePasswordConnectFactory
{
    /**
     * Creates a OnePasswordConnect object with all required
     * objects instantiated and ready for usage.
     *
     * @param string $accessToken
     * @param string $baseUri
     * @return OnePasswordConnect
     */
    public static function create(
        string $accessToken,
        string $baseUri = OnePasswordClient::DEFAULT_API_URI
    ): OnePasswordConnect {
        $httpClient = new Client();
        $opcClient = new OnePasswordClient($httpClient, $accessToken, $baseUri);
        $vaultHydrator = new VaultHydrator();
        $vaultPrototype = new Vault();
        $itemHydrator = new ItemHydrator($vaultHydrator, $vaultPrototype);
        $itemPrototype = new Item();
        return new OnePasswordConnect(
            $opcClient,
            $vaultHydrator,
            $vaultPrototype,
            $itemHydrator,
            $itemPrototype
        );
    }
}
