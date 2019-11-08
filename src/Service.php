<?php


namespace Lvzhihao\Nacos;


class Service extends Client implements ServiceInterface
{

    public function create(string $serviceName, array $options = []): NacosResponse
    {
        $params = [
            "form_params" => array_merge(["serviceName" => $serviceName], $this->resolveOptions(
                $options, ["groupName", "namespaceId", "protectThreshold", "metadata", "selector"]
            )),
        ];
        return $this->request("POST", "/nacos/v1/ns/service", $params);
    }

    public function destroy(string $serviceName, array $options = []): NacosResponse
    {
        $params = [
            "query" => array_merge(["serviceName" => $serviceName], $this->resolveOptions(
                $options, ["groupName", "namespaceId"]
            )),
        ];
        return $this->request("DELETE", "/nacos/v1/ns/service", $params);
    }

    public function update(string $serviceName, array $options = []): NacosResponse
    {
        $params = [
            "form_params" => array_merge(["serviceName" => $serviceName], $this->resolveOptions(
                $options, ["groupName", "namespaceId", "protectThreshold", "metadata", "selector"]
            )),
        ];
        return $this->request("PUT", "/nacos/v1/ns/service", $params);
    }

    public function get(string $serviceName, array $options = []): NacosResponse
    {
        $params = [
            "query" => array_merge(["serviceName" => $serviceName], $this->resolveOptions(
                $options, ["groupName", "namespaceId"]
            )),
        ];
        return $this->request("GET", "/nacos/v1/ns/service", $params);
    }

    public function list(int $pageNo, int $pageSize, array $options = []): NacosResponse
    {
        $params = [
            "query" => array_merge(["pageNo" => $pageNo, "pageSize" => $pageSize], $this->resolveOptions(
                $options, ["groupName", "namespaceId"]
            )),
        ];
        return $this->request("GET", "/nacos/v1/ns/service/list", $params);
    }
}