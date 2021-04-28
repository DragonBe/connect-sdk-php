<?php
declare(strict_types=1);

namespace OnePassword\Connect;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

final class OnePasswordClient extends AbstractOnePasswordClient
{
    public const USER_AGENT = 'OnePassword/connect-sdk-php 0.0.1';
    public const CONTENT_TYPE = 'application/json';
    public const DEFAULT_API_URI = 'http://localhost:8080';
    public const API_VERSION = 'v1';

    private string $accessToken;
    private string $baseUri;

    /**
     * OnePasswordClient constructor.
     *
     * @param Client $client
     * @param string $accessToken
     * @param string $baseUri
     */
    public function __construct(
        Client $client,
        string $accessToken,
        string $baseUri = self::DEFAULT_API_URI
    ) {
        parent::__construct($client);
        $this->accessToken = $accessToken;
        $this->baseUri = $baseUri;
    }

    public function prepareRequest(
        string $method,
        string $endPoint,
        array $additionalHeaders = [],
        string $body = ''
    ): ResponseInterface {
        $uri = sprintf('%s/%s/%s', $this->baseUri, self::API_VERSION, $endPoint);
        $headers = [
            'User-Agent' => self::USER_AGENT,
            'Content-Type' => self::CONTENT_TYPE,
            'Authorization' => 'Bearer ' . $this->accessToken,
        ];
        return $this->client->request($method, $uri, ['headers' => $headers]);
    }

    public function makeRequest(Request $request): ResponseInterface
    {
        return $this->client->send($request);
    }
}
