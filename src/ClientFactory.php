<?php
declare(strict_types=1);

namespace SeamsCMS\Delivery;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientFactory
{
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'host' => 'https://delivery.seams-api.com/',
            'debug' => false,
            'guzzle_options' => [],
        ]);
    }
}
