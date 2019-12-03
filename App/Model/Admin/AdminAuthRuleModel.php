<?php

namespace App\Model\Admin;

/**
 * Class AdminAuthRuleModel
 * Create With Automatic Generator
 * @property $id int | 规则id,自增主键
 * @property $group_id int |
 * @property $menu_id int |
 * @property $name string |
 */
class AdminAuthRuleModel extends \App\Model\BaseModel
{
	protected $tableName = 'admin_auth_rule';


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

