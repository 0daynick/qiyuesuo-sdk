<?php
namespace OverNick\QiYueSuo\Providers\Contract;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package OverNick\QiYueSuo\Providers\Contract
 */
class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['contract'] = function($pimple){
          return new Client($pimple);
        };
    }

}