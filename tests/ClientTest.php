<?php

declare(strict_types=1);

namespace Test\Nacos;


use Mockery;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Test\Nacos\Stub\Client;

/**
 * Class ClientTest
 * @package Test\Nacos
 * @internal
 * @covers \Lvzhihao\Nacos\Client
 */
class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var \ReflectionMethod
     */
    private $method;

    protected function setUp(): void
    {
        $this->client = new Client(function () {
            return Mockery::mock(\GuzzleHttp\Client::class);
        });
        $reflectionClass = new ReflectionClass(Client::class);
        $method = $reflectionClass->getMethod("resolveOptions");
        $method->setAccessible(true);
        $this->method = $method;
    }

    public function testResolveOptions()
    {
        $options = [
            "foo" => "bar",
            "hello" => "world",
            "php" => "test",
        ];

        $availableOptions = [
            "foo", "php",
        ];

        $result = $this->method->invoke($this->client, $options, $availableOptions);

        $excepted = [
            "foo" => "bar",
            "php" => "test",
        ];

        $this->assertSame($excepted, $result);
    }

    public function testResolveOptionsWithoutMatch()
    {
        $options = [
            "foo" => "bar",
        ];

        $availableOptions = [
            "hello", "php",
        ];

        $result = $this->method->invoke($this->client, $options, $availableOptions);

        $this->assertSame([], $result);
    }
}