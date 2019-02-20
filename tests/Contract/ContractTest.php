<?php
namespace OverNick\QiYueSuo\Tests\Contract;

use GuzzleHttp\RequestOptions;
use OverNick\QiYueSuo\QiYueSuo;
use OverNick\QiYueSuo\Tests\BaseTestCase;

/**
 * 合同签署测试
 *
 * Class ContractTest
 * @package OverNick\QiYueSuo\Tests\Contract
 */
class ContractTest extends BaseTestCase
{

    /**
     * 通过html创建合同
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCreateContract()
    {
        $result = $this->getManager()
            ->contract
            ->createByHtml([
                'subject' => '购销合同',
                'docName' => '购销合同',
                'html' => $this->getFile('html.txt', true),
            ]);

        $this->assertApiReqSuccess($result);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCreateContractByTemplate()
    {
        $result = $this->getManager()
            ->contract
            ->createByTpl([
                'subject' => '购销合同',
                'docName' => '购销合同',
                'templateId' => '2535674180990902904',
                'templateParams' => json_encode([
                    'order' => $this->getFile('test.txt', true)
                ])
            ]);

        $this->assertApiReqSuccess($result);
    }

    /**
     * 获取签署页面
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testSignUrl()
    {
        $result = $this->getManager()
            ->contract
            ->signUrl([
                'documentId' => '2535387873905738486',
                'operation' => QiYueSuo::SIGN_TYPE_PC,
                'signer' => json_encode([
                    'type' => QiYueSuo::TYPE_COMPANY,
                    'name' => '深圳测试2科技有限公司',
                    'registerNo' => '91132508MA09MU1L48'
                ]),
                'sealImageBase64' => $this->getFile('seal.txt', true),
                'successUrl' => 'http://www.baidu.com'
            ]);

        $this->assertApiReqSuccess($result);
    }

    /**
     * 查看合同
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testViewUrl()
    {
        $result = $this->getManager()
            ->contract
            ->viewUrl('2535680869307753119');

        $this->assertApiReqSuccess($result);
    }

    /**
     * 签署成功
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testSignComplete()
    {
        $result = $this->getManager()
            ->contract
            ->complete('2535387873905738486');

        $this->assertApiReqSuccess($result);
    }

    /**
     * 查看合同签署记录
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testFindContract()
    {
        $result = $this->getManager()
            ->contract
            ->find('2535387873905738486');

        $this->assertApiReqSuccess($result);
    }

    /**
     * 下载合同
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testDownloadContract()
    {
        $result = $this->getManager()
            ->setRequestOptions([
                'sink' => $this->getFile('downloads/show.pdf')
            ])
            ->contract
            ->download('2535387873905738486');

        $this->assertEquals($result->getStatusCode(), 200);
    }

}