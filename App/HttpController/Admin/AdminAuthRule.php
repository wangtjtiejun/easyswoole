<?php

namespace App\HttpController\Admin;

use App\HttpController\Base;
use App\Model\Admin\AdminAuthRuleModel;
use EasySwoole\Http\Annotation\Param;
use EasySwoole\Http\Message\Status;
use EasySwoole\Validate\Validate;

/**
 * Class AdminAuthRule
 * Create With Automatic Generator
 */
class AdminAuthRule extends Base
{
	/**
	 * @api {get|post} /Admin/AdminAuthRule/add
	 * @apiName add
	 * @apiGroup /Admin/AdminAuthRule
	 * @apiPermission
	 * @apiDescription add新增数据
	 * @Param(name="id", alias="规则id,自增主键", required="", lengthMax="8")
	 * @Param(name="group_id", alias="", required="", lengthMax="11")
	 * @Param(name="menu_id", alias="", required="", lengthMax="11")
	 * @Param(name="name", alias="", required="", lengthMax="255")
	 * @apiParam {int} id 规则id,自增主键
	 * @apiParam {int} group_id
	 * @apiParam {int} menu_id
	 * @apiParam {string} name
	 * @apiSuccess {Number} code
	 * @apiSuccess {Object[]} data
	 * @apiSuccess {String} msg
	 * @apiSuccessExample {json} Success-Response:
	 * HTTP/1.1 200 OK
	 * {"code":200,"data":{},"msg":"success"}
	 * @author: AutomaticGeneration < 1067197739@qq.com >
	 */
	public function add()
	{
		$param = $this->request()->getRequestParam();
		$data = [
		    'id'=>$param['id'],
		    'group_id'=>$param['group_id']??'0',
		    'menu_id'=>$param['menu_id']??'0',
		    'name'=>$param['name'],
		];
		$model = new AdminAuthRuleModel($data);
		$rs = $model->save();
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $model->toArray(), "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $model->lastQueryResult()->getLastError());
		}
	}


	/**
	 * @api {get|post} /Admin/AdminAuthRule/update
	 * @apiName update
	 * @apiGroup /Admin/AdminAuthRule
	 * @apiPermission
	 * @apiDescription update修改数据
	 * @Param(name="id", alias="规则id,自增主键", optional="", lengthMax="8")
	 * @Param(name="group_id", alias="", optional="", lengthMax="11")
	 * @Param(name="menu_id", alias="", optional="", lengthMax="11")
	 * @Param(name="name", alias="", optional="", lengthMax="255")
	 * @apiParam {int} id 主键id
	 * @apiParam {int} [id] 规则id,自增主键
	 * @apiParam {int} [group_id]
	 * @apiParam {int} [menu_id]
	 * @apiParam {mixed} [name]
	 * @apiSuccess {Number} code
	 * @apiSuccess {Object[]} data
	 * @apiSuccess {String} msg
	 * @apiSuccessExample {json} Success-Response:
	 * HTTP/1.1 200 OK
	 * {"code":200,"data":{},"msg":"success"}
	 * @author: AutomaticGeneration < 1067197739@qq.com >
	 */
	public function update()
	{
		$param = $this->request()->getRequestParam();
		$model = new AdminAuthRuleModel();
		$info = $model->get(['id' => $param['id']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['id'] = $param['id']??$info->id;
		$updateData['group_id'] = $param['group_id']??$info->group_id;
		$updateData['menu_id'] = $param['menu_id']??$info->menu_id;
		$updateData['name'] = $param['name']??$info->name;
		$rs = $info->update($updateData);
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $rs, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $model->lastQueryResult()->getLastError());
		}
	}


	/**
	 * @api {get|post} /Admin/AdminAuthRule/getOne
	 * @apiName getOne
	 * @apiGroup /Admin/AdminAuthRule
	 * @apiPermission
	 * @apiDescription 根据主键获取一条信息
	 * @Param(name="id", alias="规则id,自增主键", optional="", lengthMax="8")
	 * @apiParam {int} id 主键id
	 * @apiSuccess {Number} code
	 * @apiSuccess {Object[]} data
	 * @apiSuccess {String} msg
	 * @apiSuccessExample {json} Success-Response:
	 * HTTP/1.1 200 OK
	 * {"code":200,"data":{},"msg":"success"}
	 * @author: AutomaticGeneration < 1067197739@qq.com >
	 */
	public function getOne()
	{
		$param = $this->request()->getRequestParam();
		$model = new AdminAuthRuleModel();
		$bean = $model->get(['id' => $param['id']]);
		if ($bean) {
		    $this->writeJson(Status::CODE_OK, $bean, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}


	/**
	 * @api {get|post} /Admin/AdminAuthRule/getAll
	 * @apiName getAll
	 * @apiGroup /Admin/AdminAuthRule
	 * @apiPermission
	 * @apiDescription 获取一个列表
	 * @apiParam {String} [page=1]
	 * @apiParam {String} [limit=20]
	 * @apiParam {String} [keyword] 关键字,根据表的不同而不同
	 * @apiSuccess {Number} code
	 * @apiSuccess {Object[]} data
	 * @apiSuccess {String} msg
	 * @apiSuccessExample {json} Success-Response:
	 * HTTP/1.1 200 OK
	 * {"code":200,"data":{},"msg":"success"}
	 * @author: AutomaticGeneration < 1067197739@qq.com >
	 */
	public function getAll()
	{
		$param = $this->request()->getRequestParam();
		$page = (int)($param['page']??1);
		$limit = (int)($param['limit']??20);
		$model = new AdminAuthRuleModel();
		$data = $model->getAll($page, $param['keyword']??null, $limit);
		$this->writeJson(Status::CODE_OK, $data, 'success');
	}


	/**
	 * @api {get|post} /Admin/AdminAuthRule/delete
	 * @apiName delete
	 * @apiGroup /Admin/AdminAuthRule
	 * @apiPermission
	 * @apiDescription 根据主键删除一条信息
	 * @Param(name="id", alias="规则id,自增主键", optional="", lengthMax="8")
	 * @apiParam {int} id 主键id
	 * @apiSuccess {Number} code
	 * @apiSuccess {Object[]} data
	 * @apiSuccess {String} msg
	 * @apiSuccessExample {json} Success-Response:
	 * HTTP/1.1 200 OK
	 * {"code":200,"data":{},"msg":"success"}
	 * @author: AutomaticGeneration < 1067197739@qq.com >
	 */
	public function delete()
	{
		$param = $this->request()->getRequestParam();
		$model = new AdminAuthRuleModel();

		$rs = $model->destroy(['id' => $param['id']]);
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, [], "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}
}

