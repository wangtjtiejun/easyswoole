<?php

namespace App\Model\Admin;

/**
 * Class ConfiModel
 * Create With Automatic Generator
 * @property $id int | 配置ID
 * @property $name string | 配置名称
 * @property $value string | 配置值
 * @property $info string | 描述
 * @property $module string | 所属模块
 * @property $extend_value string | 扩展值
 * @property $use_for string | 用于
 * @property $status int | 状态，1启用，0禁用
 * @property $sort_order int | 排序
 */
class ConfiModel extends \App\Model\BaseModel
{
	protected $tableName = 'config';


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

