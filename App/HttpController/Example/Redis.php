<?php
/**
 * Created by PhpStorm.
 * User: wangtiejun
 * Date: 2019/11/22
 * Time: 10:23
 */

namespace App\HttpController\Example;


use EasySwoole\Http\AbstractInterface\Controller;

class Redis extends Controller
{
    // 连接池应用
    public function index()
    {
        go(function () {
            //defer方式获取连接
            $redis = \EasySwoole\RedisPool\Redis::defer('redis');
            $redis->set('a', 10);

            //invoke方式获取连接
            \EasySwoole\RedisPool\Redis::invoker('redis', function (\EasySwoole\Redis\Redis $redis) {
                var_dump($redis->set('a', 20));
                var_dump($redis->get("a"));
            });

            var_dump($redis->get("a"));
            //获取连接池对象
            $redisPool = \EasySwoole\RedisPool\Redis::getInstance()->get('redis');

            $redis = $redisPool->getObj();
            $redisPool->recycleObj($redis);

            //清除pool中的定时器
            \EasySwoole\Component\Timer::getInstance()->clearAll();
        });
    }
}