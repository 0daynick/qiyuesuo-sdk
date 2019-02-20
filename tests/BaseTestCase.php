<?php
namespace OverNick\QiYueSuo\Tests;

use OverNick\QiYueSuo\Manager;
use PHPUnit\Framework\TestCase;

/**
 * Class BaseTestCase
 * @package OverNick\QiYueSuo\Tests
 */
class BaseTestCase extends TestCase
{
    /**
     * @var Manager
     */
    protected $manager;

    /**
     * @return Manager
     */
    public function getManager()
    {
        if(!$this->manager instanceof Manager){
            $file = dirname(__DIR__).DIRECTORY_SEPARATOR.'config/qiyuesuo.dev.php';
            $config = file_exists($file) ? include $file : [];
            return $this->manager = new Manager($config);
        }
        return $this->manager;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $result
     */
    public function assertApiReqSuccess(\Psr\Http\Message\ResponseInterface $result)
    {
        $this->assertEquals(200, $result->getStatusCode());

        if($result->getStatusCode() !== 200){
            $data = $this->getManager()->format($result);

            $this->assertEquals($data['code'], 0);
        }
    }

    /**
     * @param $file
     * @param $read
     *
     * @return string
     */
    public function getFile($file, $read = false)
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . 'files/' . $file;

        return $read ? file_get_contents($path) : $path;
    }
}