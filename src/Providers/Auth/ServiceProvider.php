<?php
namespace OverNick\QiYueSuo\Providers\Auth;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package OverNick\QiYueSuo\Providers\Auth
 */
class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['auth'] = function($pimple){
            return new Client($pimple);
        };
    }

}