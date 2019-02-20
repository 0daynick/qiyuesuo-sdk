<?php
namespace OverNick\QiYueSuo\Tests\Auth;

use OverNick\QiYueSuo\Tests\BaseTestCase;

/**
 * 认证测试
 *
 * Class AuthTest
 * @package OverNick\QiYueSuo\Tests\Auth
 */
class AuthTest extends BaseTestCase
{

    /**
     * 公司认证
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCreateAuth()
    {
        $result = $this->getManager()->auth->company([
            'name' => '深圳测试科技有限公司',
            'registerNo' => '91132508MA09MU1L48',
            'license' => $this->getFile('license.jpg'),
            'operAuthorization' => $this->getFile('operAuthorization.txt'),
            'legalPerson' => '张三',
            'legalPersonId' => '445015196508181234',
            'contact' => '李四',
            'contactPhone' => '13000000000'
        ]);

        $this->assertApiReqSuccess($result);
    }

    /**
     * 公司认证查询
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testFindCompanyAuth()
    {
        $result = $this->getManager()->auth->findByCompanyName('深圳测试科技有限公司');

        $this->assertApiReqSuccess($result);
    }

}