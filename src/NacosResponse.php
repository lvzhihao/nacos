<?php

declare(strict_types=1);

namespace Lvzhihao\Nacos;


use Lvzhihao\Nacos\Exception\ServerException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class NacosResponse
 * @package Lvzhihao\Nacos
 */
class NacosResponse
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * NacosResponse constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return  $this->response->{$name}(...$arguments);
    }

    /**
     * @param string|null $key
     * @param mixed|null $default
     * @return mixed|mixed
     */
    public function json(string $key = null, $default = null)
    {
        if ($this->response->getHeaderLine('Content-Type') !== 'application/json;charset=UTF-8') {
            throw new ServerException('The Content-Type of response is not equal application/json');
        }
        $data = json_decode($this->response->getBody()->getContents(), true);
        if (is_null($key)) {
            return $data;
        }
        if (array_key_exists($key, $data)) {
            return $data[$key];
        } else {
            return $default;
        }
    }
}