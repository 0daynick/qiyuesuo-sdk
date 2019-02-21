<?php
namespace OverNick\QiYueSuo;

use GuzzleHttp\Client;
use OverNick\QiYueSuo\Kernel\ServiceContainer;
use OverNick\Support\Config;

/**
 * Class Manage
 *
 * @property Config $config
 * @property Client $client
 * @property \OverNick\QiYueSuo\Providers\Contract\Client $contract
 * @property \OverNick\QiYueSuo\Providers\Auth\Client $auth
 * @property \OverNick\QiYueSuo\Providers\Seal\Client $seal
 *
 * @package OverNick\QiYueSuo
 */
class Manager extends ServiceContainer
{
    /**
     * @var array 请求选项
     */
    protected $options = [];

    /**
     * @var string 获取请求返回的原数据
     */
    protected $response;

    protected $providers = [
        Providers\Seal\ServiceProvider::class,
        Providers\Auth\ServiceProvider::class,
        Providers\Contract\ServiceProvider::class,
    ];

    /**
     * @var string 测试地址
     */
    protected $testUrl = 'https://openapi.qiyuesuo.me/';

    /**
     * @var string 正式地址
     */
    protected $productUrl = 'https://openapi.qiyuesuo.com/';

    /**
     * 请求组件
     *
     * @param $url
     * @param array $params 请求参数
     * @param string $method 请求方式
     * @param array $files 文件的字段数组
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($url, array $params = [], $method = QiYueSuo::METHOD_GET, array $files = [])
    {
        $time = $this->getMicroTime();

        $option = array_merge($this->options, [
            'headers' => [
                'x-qys-open-timestamp' => $time,
                'x-qys-open-signature' => $this->getSign($time),
                'x-qys-open-accesstoken' => $this->config->get('token')
            ],
            'http_errors' => false,
            'verify' => false,
            'timeout' => 10
        ]);

        if(strtoupper($method) == QiYueSuo::METHOD_POST){

            if(empty($files)){
                $option['form_params'] = $params;
            }else{
                $multipart = [];

                foreach ($params as $key => $val){
                    $item = [
                        'name' => $key,
                        'contents' => in_array($key, $files) ? fopen($val, 'r') : $val
                    ];
                    array_push($multipart, $item);
                }
                $option['multipart'] = $multipart;
            }
        }else{
            $option['query'] = $params;
        }

        $result =  $this->client->request($method, $this->url($url), $option);

        return $result;
    }

    /**
     * 获取毫秒时间戳
     *
     * @return string
     */
    public function getMicroTime()
    {
        $comps = explode(' ', microtime());
        return sprintf('%d%03d', $comps[1], $comps[0] * 1000);
    }

    /**
     * 获取api请求链接
     *
     * @param string $url
     * @return string
     */
    public function url( string $url = '')
    {
        return ($this->config->get('sandbox', false) === true ? $this->testUrl : $this->productUrl) .
            '/' .
            ltrim($url, '/');
    }

    /**
     * 格式化输出
     *
     * @param \Psr\Http\Message\ResponseInterface $result
     * @return array
     */
    public function format(\Psr\Http\Message\ResponseInterface $result) : array
    {
        $this->response = $result->getBody()->getContents();

        return json_decode($this->response, true);
    }

    /**
     * 设置请求内容
     *
     * @param array $options
     * @return $this
     */
    public function setRequestOptions(array $options = [])
    {
        $this->options = $options;
        return $this;
    }

    /**
     * 获取请求格式化前的原数据
     *
     * @return string
     */
    public function getRequestResponse()
    {
        return $this->response;
    }

    /**
     * 获取签名
     *
     * @param $time
     * @return string
     */
    public function getSign($time)
    {
        return md5(
            $this->config->get('token') .
            $this->config->get('secret') .
            $time
        );
    }
}