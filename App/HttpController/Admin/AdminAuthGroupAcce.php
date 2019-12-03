<?php

namespace App\HttpController\Admin;

use App\HttpController\Base;
use App\Model\Admin\AdminAuthGroupAcceModel;
use EasySwoole\Http\Annotation\Param;
use EasySwoole\Http\Message\Status;
use EasySwoole\Validate\Validate;

/**
 * Class AdminAuthGroupAcce
 * Create With Automatic Generator
 */
class AdminAuthGroupAcce extends Base
{
	/**
	 * @api {get|post} /Admin/AdminAuthGroupAcce/add
	 * @apiName add
	 * @apiGroup /Admin/AdminAuthGroupAcce
	 * @apiPermission
	 * @apiDescription add新增数据
	 * @Param(name="uid", alias="用户id", required="", lengthMax="10")
	 * @Param(name="group_id", alias="用户组id", required="", lengthMax="8")
	 * @apiParam {int} uid 用户id
	 * @apiParam {int} group_id 用户组id
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
		    'uid'=>$param['uid'],
		    'group_id'=>$param['group_id']??'0',
		];
		$model = new AdminAuthGroupAcceModel($data);
		$rs = $model->save();
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $model->toArray(), "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $model->lastQueryResult()->getLastError());
		}
	}


	/**
	 * @api {get|post} /Admin/AdminAuthGroupAcce/update
	 * @apiName update
	 * @apiGroup /Admin/AdminAuthGroupAcce
	 * @apiPermission
	 * @apiDescription update修改数据
	 * @Param(name="uid", alias="用户id", optional="", lengthMax="10")
	 * @Param(name="group_id", alias="用户组id", optional="", lengthMax="8")
	 * @apiParam {int} uid 主键id
	 * @apiParam {int} [uid] 用户id
	 * @apiParam {int} [group_id] 用户组id
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
		$model = new AdminAuthGroupAcceModel();
		$info = $model->get(['uid' => $param['uid']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['uid'] = $param['uid']??$info->uid;
		$updateData['group_id'] = $param['group_id']??$info->group_id;
		$rs = $info->update($updateData);
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $rs, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $model->lastQueryResult()->getLastError());
		}
	}


	/**
	 * @api {get|post} /Admin/AdminAuthGroupAcce/getOne
	 * @apiName getOne
	 * @apiGroup /Admin/AdminAuthGroupAcce
	 * @apiPermission
	 * @apiDescription 根据主键获取一条信息
	 * @Param(name="uid", alias="用户id", optional="", lengthMax="10")
	 * @apiParam {int} uid 主键id
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
		$model = new AdminAuthGroupAcceModel();
		$bean = $model->get(['uid' => $param['uid']]);
		if ($bean) {
		    $this->writeJson(Status::CODE_OK, $bean, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}


	/**
	 * @api {get|post} /Admin/AdminAuthGroupAcce/getAll
	 * @apiName getAll
	 * @apiGroup /Admin/AdminAuthGroupAcce
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
		$model = new AdminAuthGroupAcceModel();
		$data = $model->getAll($page, $param['keyword']??null, $limit);
		$this->writeJson(Status::CODE_OK, $data, 'success');
	}


	/**
	 * @api {get|post} /Admin/AdminAuthGroupAcce/delete
	 * @apiName delete
	 * @apiGroup /Admin/AdminAuthGroupAcce
	 * @apiPermission
	 * @apiDescription 根据主键删除一条信息
	 * @Param(name="uid", alias="用户id", optional="", lengthMax="10")
	 * @apiParam {int} uid 主键id
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
		$model = new AdminAuthGroupAcceModel();

		$rs = $model->destroy(['uid' => $param['uid']]);
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, [], "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}
}

