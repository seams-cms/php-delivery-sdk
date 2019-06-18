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

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ClientFactory
 * @package SeamsCMS\Delivery
 */
class ClientFactory
{
    /**
     * @param string $apiKey
     * @param string $workspace
     * @param array $options
     * @return Client
     */
    public function build(string $apiKey, string $workspace, $options = array()): Client
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

        $guzzleClient = new \GuzzleHttp\Client($options);

        return new Client($guzzleClient, $workspace);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'host' => 'https://delivery.seams-api.com/',
            'debug' => false,
            'guzzle_options' => [],
        ]);
    }
}
