<?php
/**
 * Created by PhpStorm.
 * User: wangtiejun
 * Date: 2019/12/2
 * Time: 16:31
 */

namespace App\Queue;

use EasySwoole\Component\Singleton;
use EasySwoole\Queue\Queue;

/**
 * Class MyQueue
 * @package App\Queue
 * 定义一个队列
 */
class MyQueue extends Queue
{
    use Singleton;
}