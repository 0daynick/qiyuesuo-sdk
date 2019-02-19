<?php
namespace OverNick\QiYueSuo\Kernel;

use OverNick\QiYueSuo\Manager;

/**
 * Class BaseClient
 * @package OverNick\QiYueSuo\Kernel
 */
abstract class BaseClient
{
    /**
     * @var Manager
     */
    protected $app;

    public function __construct(Manager $app)
    {
        $this->app = $app;
    }
}