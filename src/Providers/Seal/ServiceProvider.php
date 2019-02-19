<?php
namespace OverNick\QiYueSuo\Providers\Seal;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * 印章管理
 *
 * Class ServiceProvider
 * @package OverNick\QiYueSuo\Providers
 */
class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['seal'] = function($pimple){
            return new Client($pimple);
        };
    }

}