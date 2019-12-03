<?php

namespace App\Model\Admin;

/**
 * Class AdminModel
 * Create With Automatic Generator
 * @property $adminId int |
 * @property $adminName string |
 * @property $adminAccount string |
 * @property $adminPassword string |
 * @property $adminSession string |
 * @property $adminLastLoginTime int |
 * @property $adminLastLoginIp string |
 */
class AdminModel extends \App\Model\BaseModel
{
	protected $tableName = 'admin';


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

