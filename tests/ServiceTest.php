<?php


namespace Test\Nacos;


use GuzzleHttp\Client;
use Lvzhihao\Nacos\Service;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    /**
     * @var Service
     */
    private $service;

    protected function setUp(): void
    {
        $logger = new Logger("stdout");
        $logger->pushHandler(new StdoutHandler());
        $this->service = new Service(function() {
            return new Client([
                "base_uri" => Service::DEFAULT_URI,
            ]);
        }, $logger);
    }

    public function testServiceCreate()
    {
        $response = $this->service->create("demoService", [
            "protectThreshold" => 0.9
        ]);
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testServiceDestroy()
    {
        $response = $this->service->destroy("demoService");
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testServiceList()
    {
        $response = $this->service->list(1, 10);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertIsArray($response->json());
    }
}