<?php
declare(strict_types=1);

namespace OnePassword\Connect;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractOnePasswordClient
{
    protected ClientInterface $client;

    /**
     * AbstractOnePasswordClient constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    abstract public function prepareRequest(
        string $method,
        string $endPoint,
        array $additionalHeaders = [],
        string $body = ''
    ): ResponseInterface;

    abstract public function makeRequest(Request $request): ResponseInterface;
}
