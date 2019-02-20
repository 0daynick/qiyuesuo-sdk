<?php
namespace OverNick\QiYueSuo\Providers\Seal;

use OverNick\QiYueSuo\Kernel\BaseClient;
use OverNick\QiYueSuo\QiYueSuo;

/**
 * 印章相关
 *
 * Class Client
 * @package OverNick\QiYueSuo\Providers
 */
class Client extends BaseClient
{
    /**
     * 创建印章
     *
     * @param string $name      印章名称
     * @param int $type         印章类型，1为公司，2为用户
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createSeal(string $name ,int $type = QiYueSuo::TYPE_COMPANY)
    {
        $url = $type === QiYueSuo::TYPE_COMPANY ? 'seal/companyseal' : '/seal/personalseal';

        return $this->app->request($url, [
            'name' => $name
        ], QiYueSuo::METHOD_POST);
    }


}