<?php
declare(strict_types=1);

namespace OnePassword\Connect;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Client\ClientInterface as Client;
use Psr\Http\Message\ResponseInterface as Response;

abstract class AbstractOnePasswordClient
{
    protected Client $client;

    /**
     * AbstractOnePasswordClient constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    abstract public function prepareRequest(
        string $method,
        string $endPoint,
        array $additionalHeaders = [],
        string $body = ''
    ): Response;

    abstract public function makeRequest(Request $request): Response;
}
