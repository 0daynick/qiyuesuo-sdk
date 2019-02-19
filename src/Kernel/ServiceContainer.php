<?php
namespace OverNick\QiYueSuo\Kernel;

use OverNick\Support\Config;
use Pimple\Container;

/**
 * 基类
 *
 * Class ServiceContainer
 * @package OverNick\QiYueSuo\Kernel
 */
class ServiceContainer extends Container
{
    /**
     * @var array
     */
    protected $providers = [];

    public function __construct(array $config = [])
    {
        $this->offsetSet('config', new Config($config));

        parent::__construct([]);

        $this->registerProviders($this->providers);
    }

    /**
     * Magic get access.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * Magic set access.
     *
     * @param string $id
     * @param mixed  $value
     */
    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }

    /**
     * @param array $providers
     */
    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }

}