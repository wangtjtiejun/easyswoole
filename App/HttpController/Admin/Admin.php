<?php

namespace App\HttpController\Admin;

use App\HttpController\Base;
use App\Model\Admin\AdminModel;
use EasySwoole\Http\Annotation\Param;
use EasySwoole\Http\Message\Status;
use EasySwoole\Validate\Validate;

/**
 * Class Admin
 * Create With Automatic Generator
 */
class Admin extends Base
{
	/**
	 * @api {get|post} /Admin/Admin/add
	 * @apiName add
	 * @apiGroup /Admin/Admin
	 * @apiPermission
	 * @apiDescription add新增数据
	 * @Param(name="adminId", alias="", required="", lengthMax="11")
	 * @Param(name="adminName", alias="", required="", lengthMax="15")
	 * @Param(name="adminAccount", alias="", required="", lengthMax="18")
	 * @Param(name="adminPassword", alias="", required="", lengthMax="32")
	 * @Param(name="adminSession", alias="", required="", lengthMax="32")
	 * @Param(name="adminLastLoginTime", alias="", required="", lengthMax="11")
	 * @Param(name="adminLastLoginIp", alias="", required="", lengthMax="20")
	 * @apiParam {int} adminId
	 * @apiParam {string} adminName
	 * @apiParam {string} adminAccount
	 * @apiParam {string} adminPassword
	 * @apiParam {string} adminSession
	 * @apiParam {int} adminLastLoginTime
	 * @apiParam {string} adminLastLoginIp
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
		    'adminId'=>$param['adminId'],
		    'adminName'=>$param['adminName'],
		    'adminAccount'=>$param['adminAccount'],
		    'adminPassword'=>$param['adminPassword'],
		    'adminSession'=>$param['adminSession'],
		    'adminLastLoginTime'=>$param['adminLastLoginTime'],
		    'adminLastLoginIp'=>$param['adminLastLoginIp'],
		];
		$model = new AdminModel($data);
		$rs = $model->save();
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $model->toArray(), "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $model->lastQueryResult()->getLastError());
		}
	}


	/**
	 * @api {get|post} /Admin/Admin/update
	 * @apiName update
	 * @apiGroup /Admin/Admin
	 * @apiPermission
	 * @apiDescription update修改数据
	 * @Param(name="adminId", alias="", optional="", lengthMax="11")
	 * @Param(name="adminName", alias="", optional="", lengthMax="15")
	 * @Param(name="adminAccount", alias="", optional="", lengthMax="18")
	 * @Param(name="adminPassword", alias="", optional="", lengthMax="32")
	 * @Param(name="adminSession", alias="", optional="", lengthMax="32")
	 * @Param(name="adminLastLoginTime", alias="", optional="", lengthMax="11")
	 * @Param(name="adminLastLoginIp", alias="", optional="", lengthMax="20")
	 * @apiParam {int} adminId 主键id
	 * @apiParam {int} [adminId]
	 * @apiParam {mixed} [adminName]
	 * @apiParam {mixed} [adminAccount]
	 * @apiParam {mixed} [adminPassword]
	 * @apiParam {mixed} [adminSession]
	 * @apiParam {int} [adminLastLoginTime]
	 * @apiParam {mixed} [adminLastLoginIp]
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
		$model = new AdminModel();
		$info = $model->get(['adminId' => $param['adminId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['adminId'] = $param['adminId']??$info->adminId;
		$updateData['adminName'] = $param['adminName']??$info->adminName;
		$updateData['adminAccount'] = $param['adminAccount']??$info->adminAccount;
		$updateData['adminPassword'] = $param['adminPassword']??$info->adminPassword;
		$updateData['adminSession'] = $param['adminSession']??$info->adminSession;
		$updateData['adminLastLoginTime'] = $param['adminLastLoginTime']??$info->adminLastLoginTime;
		$updateData['adminLastLoginIp'] = $param['adminLastLoginIp']??$info->adminLastLoginIp;
		$rs = $info->update($updateData);
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $rs, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $model->lastQueryResult()->getLastError());
		}
	}


	/**
	 * @api {get|post} /Admin/Admin/getOne
	 * @apiName getOne
	 * @apiGroup /Admin/Admin
	 * @apiPermission
	 * @apiDescription 根据主键获取一条信息
	 * @Param(name="adminId", alias="", optional="", lengthMax="11")
	 * @apiParam {int} adminId 主键id
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
		$model = new AdminModel();
		$bean = $model->get(['adminId' => $param['adminId']]);
		if ($bean) {
		    $this->writeJson(Status::CODE_OK, $bean, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}


	/**
	 * @api {get|post} /Admin/Admin/getAll
	 * @apiName getAll
	 * @apiGroup /Admin/Admin
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
		$model = new AdminModel();
		$data = $model->getAll($page, $param['keyword']??null, $limit);
		$this->writeJson(Status::CODE_OK, $data, 'success');
	}


	/**
	 * @api {get|post} /Admin/Admin/delete
	 * @apiName delete
	 * @apiGroup /Admin/Admin
	 * @apiPermission
	 * @apiDescription 根据主键删除一条信息
	 * @Param(name="adminId", alias="", optional="", lengthMax="11")
	 * @apiParam {int} adminId 主键id
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
		$model = new AdminModel();

		$rs = $model->destroy(['adminId' => $param['adminId']]);
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, [], "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}
}

