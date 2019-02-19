<?php
namespace OverNick\QiYueSuo\Providers\Auth;

use OverNick\QiYueSuo\Kernel\BaseClient;
use OverNick\QiYueSuo\QiYueSuo;

/**
 * 认证
 * https://open.qiyuesuo.com/document/2535028044909777428
 *
 * Class Client
 * @package OverNick\QiYueSuo\Providers
 */
class Client extends BaseClient
{

    /**
     * 提交认证
     *
     * @param $params
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function company($params)
    {
        return $this->app->request('third/company/auth/full', $params, QiYueSuo::METHOD_POST);
    }

    /**
     * 通过公司名称查询认证详情
     *
     * @param $name
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function findByCompanyName($name)
    {
        return $this->find([
            'name' => $name
        ]);
    }

    /**
     * 通过认证id查询认证结果
     *
     * @param string $id 认证id
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function findByAuthId($id)
    {
        return $this->find([
            'id' => $id
        ]);
    }

    /**
     * 查询认证详情
     *
     * @param array $params 查询参数[id,name]
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function find($params = [])
    {
        return $this->app->request('third/company/auth/detail', $params);
    }

}