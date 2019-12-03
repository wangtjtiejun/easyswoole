<?php

namespace App\Model\Admin;

/**
 * Class AdminAuthGroupModel
 * Create With Automatic Generator
 * @property $id int | 用户组id,自增主键
 * @property $title string | 用户组中文名称
 * @property $description string | 描述信息
 * @property $status int | 用户组状态：为1正常，为0禁用,-1为删除
 * @property $rules string | 用户组拥有的规则id，多个规则 , 隔开
 */
class AdminAuthGroupModel extends \App\Model\BaseModel
{
	protected $tableName = 'admin_auth_group';


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

