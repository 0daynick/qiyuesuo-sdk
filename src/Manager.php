<?php
namespace OverNick\QiYueSuo;

use GuzzleHttp\Client;
use OverNick\QiYueSuo\Kernel\ServiceContainer;
use OverNick\Support\Arr;
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

        $option = [
            'headers' => [
                'x-qys-open-timestamp' => $time,
                'x-qys-open-signature' => $this->getSign($time),
                'x-qys-open-accesstoken' => $this->config->get('token')
            ],
            'http_errors' => false,
            'verify' => false
        ];

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

        $result =  $this->getHttpClient()->request($method, $this->url($url), $option);

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
        return ($this->config->get('sandbox', false) === true ? $this->testUrl :  $this->productUrl) . $url;
    }

    /**
     * 格式化输出
     *
     * @param string $result
     * @return string
     */
    public function format(string $result) : string
    {
        return json_decode($result);
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

    /**
     * 获取请求组件
     *
     * @return Client
     */
    public function getHttpClient()
    {
        if(!$this->offsetExists('client')){
            $this->offsetSet('client', new Client());
        }

        return $this->client;
    }

}