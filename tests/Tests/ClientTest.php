<?php

namespace SeamsCMS\Delivery\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Exception\BaseException;
use SeamsCMS\Delivery\Exception\RateLimitException;
use SeamsCMS\Delivery\Exception\UnauthorizedException;

class ClientTest extends TestCase
{

    /** @var \PHPUnit\Framework\MockObject\MockObject|Client */
    protected $guzzleMock;

    public function testClientApiKeyFailure()
    {
        $client = $this->getClient();

        $request = new Request('get', 'foobar');
        $response = new Response(401);
        $e = BadResponseException::create($request, $response);
        $this->guzzleMock->method('request')->willThrowException($e);

        $this->expectException(UnauthorizedException::class);
        $client->getAssetCollection();
    }

    public function testNullResponseFailure()
    {
        $client = $this->getClient();

        $request = new Request('get', 'foobar');
        // @TODO: null-response is deprecated and removed in guzzle7
        $e = BadResponseException::create($request, null);
        $this->guzzleMock->method('request')->willThrowException($e);

        $this->expectException(BaseException::class);
        $this->expectExceptionMessage('Guzzle exception');
        $client->getAssetCollection();
    }

    public function testRateLimit()
    {
        $client = $this->getClient();

        $request = new Request('get', 'foobar');
        $response = new Response(429, array(
            'x-ratelimit-limit' => 123,
            'x-ratelimit-reset' => 120000,
        ));
        $e = BadResponseException::create($request, $response);
        $this->guzzleMock->method('request')->willThrowException($e);

        $this->expectException(RateLimitException::class);
        $this->expectExceptionMessage('Rate-limit in effect');
        // @TODO: Check if rate-limit and reset are correct in the ratelimit exception class
        $client->getAssetCollection();
    }

    public function testGenericErrorMessageWithJsonError()
    {
        $client = $this->getClient();

        $json = json_encode(array(
            'error' => 'phpunit test error',
        ));

        $request = new Request('get', 'foobar');
        $response = new Response(404, [], $json);
        $e = BadResponseException::create($request, $response);
        $this->guzzleMock->method('request')->willThrowException($e);

        $this->expectException(\SeamsCMS\Delivery\Exception\BadResponseException::class);
        $this->expectExceptionMessage('phpunit test error');

        $client->getAssetCollection();
    }

    public function testGenericErrorMessageWithoutJsonError()
    {
        $client = $this->getClient();

        $json = json_encode(array(
            'message' => 'not visible',
        ));

        $request = new Request('get', 'foobar');
        $response = new Response(404, [], $json);
        $e = BadResponseException::create($request, $response);
        $this->guzzleMock->method('request')->willThrowException($e);

        $this->expectException(\SeamsCMS\Delivery\Exception\BadResponseException::class);
        $this->expectExceptionMessage('404 Not Found');

        $client->getAssetCollection();
    }

    public function testAssetCollection()
    {
        $client = $this->getClient();

        $json = array(
            'entries' => [],
            'meta' => [
                'offset' => 0,
                'limit' => 10,
                'count' => 0,
            ],
        );

        $response = new Response(200, [], json_encode($json));
        $this->guzzleMock->method('request')->willReturn($response);

        $collection = $client->getAssetCollection();

        $this->assertCount(0, $collection->getEntries());
    }

    public function testWorkspaceCollection()
    {
        $client = $this->getClient();

        $json = array(
            'entries' => [],
            'meta' => [
                'offset' => 0,
                'limit' => 10,
                'count' => 0,
            ],
        );

        $response = new Response(200, [], json_encode($json));
        $this->guzzleMock->method('request')->willReturn($response);

        $collection = $client->getWorkspaceCollection();

        $this->assertCount(0, $collection->getEntries());
    }

    public function testContentTypeCollection()
    {
        $client = $this->getClient();

        $json = array(
            'entries' => [],
            'meta' => [
                'offset' => 0,
                'limit' => 10,
                'count' => 0,
            ],
        );

        $response = new Response(200, [], json_encode($json));
        $this->guzzleMock->method('request')->willReturn($response);

        $collection = $client->getContentTypeCollection();

        $this->assertCount(0, $collection->getEntries());
    }

    public function testContentType()
    {
        $client = $this->getClient();

        $json = array(
            'fields' => [],
            'description' => 'desc',
            'id' => 'id',
            'name' => 'name',
        );

        $response = new Response(200, [], json_encode($json));
        $this->guzzleMock->method('request')->willReturn($response);

        $type = $client->getContentType('foobar');
        $this->assertEquals('id', $type->getId());
        $this->assertEquals('desc', $type->getDescription());
        $this->assertEquals('name', $type->getName());
    }



    protected function getClient()
    {
        $this->guzzleMock = $this->getMockBuilder(Client::class)->getMock();

        return new \SeamsCMS\Delivery\Client($this->guzzleMock, 'foobar');
    }
}
