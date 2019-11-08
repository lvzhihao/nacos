<?php


namespace Lvzhihao\Nacos;


interface ServiceInterface
{
    public function create(string $serviceName, array $options = []): NacosResponse;

    public function destroy(string $serviceName, array $options = []): NacosResponse;

    public function update(string $serviceName, array $options = []): NacosResponse;

    public function get(string $serviceName, array $options = []): NacosResponse;

    public function list(int $page, int $size,  array $options = []): NacosResponse;
}