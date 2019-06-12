<?php
declare(strict_types=1);

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Client;
use SeamsCMS\Delivery\ClientFactory;

class ClientFactoryTest extends TestCase
{
    /** @var ClientFactory */
    private $factory;

    protected function setUp()
    {
        $this->factory = new ClientFactory();
    }

    public function testBuildReturnsClient()
    {
        $actual = $this->factory->build('apiKey', 'workspace');

        self::assertInstanceOf(Client::class, $actual);
    }
}
