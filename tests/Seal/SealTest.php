<?php
namespace OverNick\QiYueSuo\Tests\Seal;

use OverNick\QiYueSuo\Tests\BaseTestCase;

/**
 * 印章测试
 *
 * Class SealTest
 * @package OverNick\QiYueSuo\Tests\Seal
 */
class SealTest extends BaseTestCase
{

    /**
     * 创建公司印章
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testSealCreate()
    {
        $result = $this->getManager()
            ->seal
            ->createSeal('深圳测试科技有限公司');

        $this->assertApiReqSuccess($result);
    }

}