<?php

namespace App\HttpController\Admin;

use App\HttpController\Base;
use App\Model\Admin\AdminAuthGroupModel;
use EasySwoole\Http\Annotation\Param;
use EasySwoole\Http\Message\Status;
use EasySwoole\Validate\Validate;

/**
 * Class AdminAuthGroup
 * Create With Automatic Generator
 */
class AdminAuthGroup extends Base
{
	/**
	 * @api {get|post} /Admin/AdminAuthGroup/add
	 * @apiName add
	 * @apiGroup /Admin/AdminAuthGroup
	 * @apiPermission
	 * @apiDescription add新增数据
	 * @Param(name="id", alias="用户组id,自增主键", required="", lengthMax="8")
	 * @Param(name="title", alias="用户组中文名称", required="", lengthMax="20")
	 * @Param(name="description", alias="描述信息", required="", lengthMax="80")
	 * @Param(name="status", alias="用户组状态：为1正常，为0禁用,-1为删除", required="", lengthMax="1")
	 * @Param(name="rules", alias="用户组拥有的规则id，多个规则 , 隔开", required="", lengthMax="")
	 * @apiParam {int} id 用户组id,自增主键
	 * @apiParam {string} title 用户组中文名称
	 * @apiParam {string} description 描述信息
	 * @apiParam {int} status 用户组状态：为1正常，为0禁用,-1为删除
	 * @apiParam {string} rules 用户组拥有的规则id，多个规则 , 隔开
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
		    'title'=>$param['title'],
		    'description'=>$param['description'],
		    'status'=>$param['status']??'1',
		    'rules'=>$param['rules'],
		];
		$model = new AdminAuthGroupModel($data);
		$rs = $model->save();
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $model->toArray(), "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $model->lastQueryResult()->getLastError());
		}
	}


	/**
	 * @api {get|post} /Admin/AdminAuthGroup/update
	 * @apiName update
	 * @apiGroup /Admin/AdminAuthGroup
	 * @apiPermission
	 * @apiDescription update修改数据
	 * @Param(name="id", alias="用户组id,自增主键", optional="", lengthMax="8")
	 * @Param(name="title", alias="用户组中文名称", optional="", lengthMax="20")
	 * @Param(name="description", alias="描述信息", optional="", lengthMax="80")
	 * @Param(name="status", alias="用户组状态：为1正常，为0禁用,-1为删除", optional="", lengthMax="1")
	 * @Param(name="rules", alias="用户组拥有的规则id，多个规则 , 隔开", optional="", lengthMax="")
	 * @apiParam {int} id 主键id
	 * @apiParam {int} [id] 用户组id,自增主键
	 * @apiParam {mixed} [title] 用户组中文名称
	 * @apiParam {mixed} [description] 描述信息
	 * @apiParam {int} [status] 用户组状态：为1正常，为0禁用,-1为删除
	 * @apiParam {mixed} [rules] 用户组拥有的规则id，多个规则 , 隔开
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
		$model = new AdminAuthGroupModel();
		$info = $model->get(['id' => $param['id']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['id'] = $param['id']??$info->id;
		$updateData['title'] = $param['title']??$info->title;
		$updateData['description'] = $param['description']??$info->description;
		$updateData['status'] = $param['status']??$info->status;
		$updateData['rules'] = $param['rules']??$info->rules;
		$rs = $info->update($updateData);
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $rs, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $model->lastQueryResult()->getLastError());
		}
	}


	/**
	 * @api {get|post} /Admin/AdminAuthGroup/getOne
	 * @apiName getOne
	 * @apiGroup /Admin/AdminAuthGroup
	 * @apiPermission
	 * @apiDescription 根据主键获取一条信息
	 * @Param(name="id", alias="用户组id,自增主键", optional="", lengthMax="8")
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
		$model = new AdminAuthGroupModel();
		$bean = $model->get(['id' => $param['id']]);
		if ($bean) {
		    $this->writeJson(Status::CODE_OK, $bean, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}


	/**
	 * @api {get|post} /Admin/AdminAuthGroup/getAll
	 * @apiName getAll
	 * @apiGroup /Admin/AdminAuthGroup
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
		$model = new AdminAuthGroupModel();
		$data = $model->getAll($page, $param['keyword']??null, $limit);
		$this->writeJson(Status::CODE_OK, $data, 'success');
	}


	/**
	 * @api {get|post} /Admin/AdminAuthGroup/delete
	 * @apiName delete
	 * @apiGroup /Admin/AdminAuthGroup
	 * @apiPermission
	 * @apiDescription 根据主键删除一条信息
	 * @Param(name="id", alias="用户组id,自增主键", optional="", lengthMax="8")
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
		$model = new AdminAuthGroupModel();

		$rs = $model->destroy(['id' => $param['id']]);
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, [], "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}
}

