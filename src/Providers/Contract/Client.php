<?php
namespace OverNick\QiYueSuo\Providers\Contract;

use OverNick\QiYueSuo\Kernel\BaseClient;
use OverNick\QiYueSuo\QiYueSuo;

/**
 * 合同
 * https://open.qiyuesuo.com/document/2279606173093068800
 *
 * Class Client
 * @package OverNick\QiYueSuo\Providers\Contract
 */
class Client extends BaseClient
{

    /**
     * 通过PDF创建合同
     *
     * @param array $params
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createByPdfFile(array $params = [])
    {
        return $this->app->request(
            'remote/contract/createbyfile',
            $params,
            QiYueSuo::METHOD_POST,
            ['file']
        );
    }

    /**
     * 通过合同模版创建合同
     *
     * @param array $params
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createByTpl(array $params = [])
    {
        return $this->app->request(
            'remote/contract/createbytemplate',
            $params,
            QiYueSuo::METHOD_POST
        );
    }

    /**
     * 通过html内容创建合同
     *
     * @param array $params
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createByHtml(array $params = [])
    {
        return $this->app->request(
            'remote/contract/createbyhtml',
            $params,
            QiYueSuo::METHOD_POST
        );
    }

    /**
     * 运营方签署合同
     *
     * @param array $params
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function signByPlatform(array $params = [])
    {
        return $this->app->request(
            'remote/signbyplatform',
            $params,
            QiYueSuo::METHOD_POST
        );
    }

    /**
     * 企业用户签署
     *
     * @param array $params
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function signByCompany(array $params = [])
    {
        return $this->app->request(
            'remote/signbycompany',
            $params,
            QiYueSuo::METHOD_POST
        );
    }

    /**
     * 完成合同，终止合同签署状态
     *
     * @param string $documentId 合同id
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function complete($documentId)
    {
        return $this->app->request(
            'remote/complete',
            ['documentId' => $documentId],
            QiYueSuo::METHOD_POST
        );
    }

    /**
     * 查看合同
     *
     * @param string $documentId  合同id
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function find($documentId)
    {
        return $this->app->request(
            'remote/contract/detail',
            ['documentId' => $documentId]
        );
    }

    /**
     * 下载合同
     *
     * @param string $documentId 合同编号
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function download($documentId)
    {
        return $this->app->request(
            'remote/document/download',
            ['documentId' => $documentId]
        );
    }

    /**
     * 获取签署页面链接
     *
     * @param array $params
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function signUrl(array $params = [])
    {
        return $this->app->request(
            'remote/contract/signurl',
            $params,
            QiYueSuo::METHOD_POST
        );
    }

    /**
     * 获取查看合同页面的链接
     *
     * @param string $documentId  文档id
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function viewUrl($documentId)
    {
        return $this->app->request(
            'remote/contract/viewurl',
            ['documentId' => $documentId],
            QiYueSuo::METHOD_POST
        );
    }

    /**
     * 触发回调地址测试请求
     *
     * @param $signCallBackUrl
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCallBack($signCallBackUrl)
    {
        return $this->app->request(
            'remote/contract/callbackcheckout',
            ['signCallBackUrl' => $signCallBackUrl],
            QiYueSuo::METHOD_POST
        );
    }

}