<?php

namespace App\Model\Admin;

/**
 * Class AdminMenuModel
 * Create With Automatic Generator
 * @property $id int | 文档ID
 * @property $module string |
 * @property $pid int | 上级分类ID
 * @property $title string | 标题
 * @property $url string | 链接地址
 * @property $icon string |
 * @property $sort_order int | 排序（同级有效）
 * @property $type string | nav,auth
 * @property $status int |
 */
class AdminMenuModel extends \App\Model\BaseModel
{
	protected $tableName = 'admin_menu';


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

