<?php
/**
 * Created by PhpStorm.
 * User: wangtiejun
 * Date: 2019/11/21
 * Time: 20:16
 */
namespace App\Queue;

use App\Utility\Pool\RedisObject;

class Queue
{
    private $redis;
    static public $queue = 'queue';

    function __construct(RedisObject $redis)
    {
        $this->redis = $redis;
    }

    function rPop()
    {
        $rs = $this->redis->rPop(self::$queue);
        return $rs;
    }

    function lPush($data)
    {
        $rs = $this->redis->lpush(self::$queue, $data);
        return $rs;
    }
}

