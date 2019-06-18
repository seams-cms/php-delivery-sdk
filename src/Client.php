<?php

declare(strict_types=1);

/*
 * This file is part of the -SeamsCMSDeliverySdk package.
 *
 * (c) Seams-CMS.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeamsCMS\Delivery;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException as GuzzleBadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Uri;
use SeamsCMS\Delivery\Exception\BadResponseException;
use SeamsCMS\Delivery\Exception\BaseException;
use SeamsCMS\Delivery\Exception\RateLimitException;
use SeamsCMS\Delivery\Exception\UnauthorizedException;
use SeamsCMS\Delivery\Model\AssetCollection;
use SeamsCMS\Delivery\Model\Content;
use SeamsCMS\Delivery\Model\ContentCollection;
use SeamsCMS\Delivery\Model\ContentType;
use SeamsCMS\Delivery\Model\ContentTypeCollection;
use SeamsCMS\Delivery\Model\WorkspaceCollection;

/**
 * Class Client
 * @package SeamsCMS\Delivery
 *
 * @SuppressWarnings("Coupling")
 */
class Client
{
    /** @var string */
    protected $workspace;

    /** @var ClientInterface */
    protected $client;

    /**
     * Client constructor.
     *
     * @param ClientInterface $client
     * @param string $workspace
     */
    public function __construct(ClientInterface $client, string $workspace)
    {
        $this->client = $client;
        $this->workspace = $workspace;
    }

    /**
     * @return WorkspaceCollection
     */
    public function getWorkspaceCollection(): WorkspaceCollection
    {
        $json = $this->makeApiRequest('get', sprintf('/workspace/%s', $this->workspace));

        $data = json_decode($json, true);
        return WorkspaceCollection::fromArray($data);
    }


    /**
     * @return AssetCollection
     */
    public function getAssetCollection(): AssetCollection
    {
        $json = $this->makeApiRequest('get', sprintf('/workspace/%s/assets', $this->workspace));

        $data = json_decode($json, true);
        return AssetCollection::fromArray($data);
    }

    /**
     * @return ContentTypeCollection
     */
    public function getContentTypeCollection(): ContentTypeCollection
    {
        $json = $this->makeApiRequest('get', sprintf('/workspace/%s/types', $this->workspace));

        $data = json_decode($json, true);
        return ContentTypeCollection::fromArray($data);
    }

    /**
     * @param string $type
     * @return ContentType
     */
    public function getContentType(string $type): ContentType
    {
        $json = $this->makeApiRequest('get', sprintf('/workspace/%s/type/%s', $this->workspace, $type));

        $data = json_decode($json, true);
        return ContentType::fromArray($data);
    }

    /**
     * @param string $type
     *
     * @param Filter|null $filter
     * @return ContentCollection
     */
    public function getContentCollection(string $type, Filter $filter = null): ContentCollection
    {
        $queryString = ParseFilter::generateQueryString($filter);

        $json = $this->makeApiRequest('get',
            sprintf('/workspace/%s/type/%s/entries?%s', $this->workspace, $type, $queryString)
        );

        $data = json_decode($json, true);
        return ContentCollection::fromArray($data);
    }

    /**
     * @param string $entryId
     *
     * @return Content
     */
    public function getEntry(string $entryId): Content
    {
        $json = $this->makeApiRequest('get', sprintf('/workspace/%s/entry/%s', $this->workspace, $entryId));

        $data = json_decode($json, true);
        return Content::fromArray($data);
    }

    /**
     * @param string $method
     * @param string|Uri $url
     * @return string
     */
    private function makeApiRequest(string $method, $url): string
    {
        try {
            $response = $this->client->request($method, $url);
        } catch (GuzzleBadResponseException $e) {
            if ($e->getCode() == 401) {
                throw new UnauthorizedException('Invalid API key');
            }

            $response = $e->getResponse();
            if (is_null($response)) {
                throw new BaseException('Guzzle exception', $e->getCode(), $e);
            }

            if ($e->getCode() == 429) {
                throw new RateLimitException(
                    (int)($response->getHeader('x-ratelimit-limit')[0]),
                    (int)($response->getHeader('x-ratelimit-reset')[0]),
                    'Rate-limit in effect'
                );
            }

            $message = $e->getMessage();

            // Extract message from json error body, if available
            $body = (string)$response->getBody();
            $json = json_decode($body, true);
            if ($json && isset($json['error'])) {
                $message = $json['error'];
            }

            throw new BadResponseException($message, $e->getCode());
        } catch (GuzzleException $e) {
            throw new BaseException('Guzzle exception', $e->getCode(), $e);
        }

        $body = (string)$response->getBody();
        return $body;
    }
}
