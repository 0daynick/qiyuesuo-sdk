<?php

return [
    /**
     * 是否开启沙盒模式，启用后将对接到测试网
     */
    'sandbox' => true,
    /**
     * 契约锁开放平台应用中获取的token
     */
    'token' => '',
    /**
     * 契约锁开放平台应用中获取的secret
     */
    'secret' => '',
    /**
     * 是否自动开启guzzle/http请求组件，
     * 如果为false, 则需要手动调用 Manager 的 bootstrapHttpClient 方法进行设置
     */
    'client' => true
];