<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery;

use GuzzleHttp\Exception\BadResponseException as GuzzleBadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use SeamsCMS\Delivery\Exception\BadResponseException;
use SeamsCMS\Delivery\Exception\BaseException;
use SeamsCMS\Delivery\Exception\RateLimitException;
use SeamsCMS\Delivery\Exception\UnauthorizedException;
use SeamsCMS\Delivery\Model\AssetCollection;
use SeamsCMS\Delivery\Model\ContentType;
use SeamsCMS\Delivery\Model\ContentTypeCollection;
use SeamsCMS\Delivery\Model\WorkspaceCollection;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Client
{
    /** @var string */
    protected $workspace;

    /** @var \GuzzleHttp\Client */
    protected $client;

    /**
     * Client constructor.
     *
     * @param string $apiKey
     * @param string $workspace
     * @param array $options
     */
    public function __construct(string $apiKey, string $workspace, $options = array())
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $resolvedOptions = $resolver->resolve($options);

        // Merge guzzle options and override with our own
        $options = $resolvedOptions['guzzle_options'];
        $options = array_merge($options, [
            'base_uri' => $resolvedOptions['host'],
            'debug' => $resolvedOptions['debug'],
            'headers' => [
                'Authorization' => "Bearer " . $apiKey,
            ],
        ]);

        $this->client = new \GuzzleHttp\Client($options);
        $this->workspace = $workspace;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'host' => 'https://delivery.seams-api.com/',
            'debug' => false,
            'guzzle_options' => [],
        ]);
    }

    /**
     *
     */
    public function getWorkspaceCollection(): WorkspaceCollection
    {
        $json = $this->makeApiRequest('get', sprintf('/workspace/%s', $this->workspace));

        return new WorkspaceCollection($json);
    }


    /**
     *
     */
    public function getAssetCollection(): AssetCollection
    {
        $json = $this->makeApiRequest('get', sprintf('/workspace/%s/assets', $this->workspace));

        return new AssetCollection($json);
    }

    /**
     *
     */
    public function getContentTypeCollection(): ContentTypeCollection
    {
        $json = $this->makeApiRequest('get', sprintf('/workspace/%s/types', $this->workspace));

        return new ContentTypeCollection($json);
    }

    /**
     * @param string $type
     * @return ContentType
     */
    public function getContentType(string $type): ContentType
    {
        $json = $this->makeApiRequest('get', sprintf('/workspace/%s/type/%s', $this->workspace, $type));

        return new ContentType($json);
    }

    /**
     * @param string $method
     * @param string $url
     * @return string
     */
    private function makeApiRequest(string $method, string $url): string
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
