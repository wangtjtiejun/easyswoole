<?php
/**
 * Created by PhpStorm.
 * User: wangtiejun
 * Date: 2019/11/21
 * Time: 10:23
 */
namespace App\Model\Admin;

use EasySwoole\ORM\AbstractModel;

class Admin extends AbstractModel
{
    protected $tableName = 'admin';

    protected $primaryKey = 'admin_id';

    /**
     * @getAll
     * @keyword user_name
     * @param int $page
     * @param string|null $keyword
     * @param int $pageSize 10
     * @return array[total, list]
     */
    public function getAll(int $page = 1, string $keyword = null, int $pageSize = 10): array
    {
        $where = [];
        if (!empty($keyword)) {
            $where['user_name'] = ['%' . $keyword . '%','like'];
        }

        $list = $this->limit($pageSize * ($page - 1), $pageSize)->order($this->primaryKey, 'DESC')->withTotalCount()->all($where);
        $total = $this->lastQueryResult()->getTotalCount();
        return ['total' => $total, 'list' => $list];
    }
}