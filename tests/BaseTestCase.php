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
}