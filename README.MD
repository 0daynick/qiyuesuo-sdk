# 契约锁SDK

https://open.qiyuesuo.com/document/2279605638927482880


## 使用（Used）

- 初始化类
```php

// 初始化
$manager = new OverNick\QiYueSuo\Manager([
    // 沙箱模式，true表示对接到测试地址
    'sandbox' => true,
    'token' => '契约锁开放平台获取的token',
    'secret' => '契约锁开放平台获取的secret'
]);

// 合同
// 实例指向 OverNick\QiYueSuo\Providers\Contract\Client
$manager->contract

// 认证
// 实例指向 OverNick\QiYueSuo\Providers\Auth\Client
$manager->auth
// 印章
// 实例指向 OverNick\QiYueSuo\Providers\Seal\Client
$manager->seal

/**
* 以上对象实例也可以通过数组的方式进行调用，Manager 实现了 ArrayAccess接口和使用了__get，__set方法
* $manager['auth']
* ...
*/
```


- 方法列表

> contract

1. 通过PDF创建合同（createByPdfFile）
2. 通过合同模版创建合同（createByTpl）
3. 通过html内容创建合同（createByHtml）
4. 运营方签署合同（signByPlatform）
5. 企业用户签署（signByCompany）
6. 完成合同，终止合同签署状态（complete）
7. 查看合同（find）
8. 下载合同（download）
9. 获取签署页面链接（signUrl）
10. 获取查看合同页面的链接（viewUrl）
11. 触发回调地址测试请求（testCallBack）

> auth
1. 提交认证（company）
2. 通过公司名称查询认证详情（findByCompanyName）
3. 通过认证id查询认证结果（findByAuthId）
4. 查询认证详情（find）

> seal
1. 创建企业/个人印章（createSeal）