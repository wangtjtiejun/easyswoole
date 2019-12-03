<?php

namespace App\Model\Admin;

/**
 * Class AdminAuthGroupAcceModel
 * Create With Automatic Generator
 * @property $uid int | 用户id
 * @property $group_id int | 用户组id
 */
class AdminAuthGroupAcceModel extends \App\Model\BaseModel
{
	protected $tableName = 'admin_auth_group_access';


	/**
	 * @getAll
	 * @param  int  $page  1
	 * @param  int  $pageSize  10
	 * @param  string  $field  *
	 * @return array[total,list]
	 */
	public function getAll(int $page = 1, int $pageSize = 10, string $field = '*'): array
	{
		$list = $this
		    ->withTotalCount()
			->order($this->schemaInfo()->getPkFiledName(), 'DESC')
		    ->field($field)
		    ->limit($pageSize * ($page - 1), $pageSize)
		    ->all();
		$total = $this->lastQueryResult()->getTotalCount();;
		return ['total' => $total, 'list' => $list];
	}
}

