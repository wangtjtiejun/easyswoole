<?php

namespace App\HttpController\Admin;

use App\HttpController\Base;
use App\Model\Admin\ConfiModel;
use EasySwoole\Http\Annotation\Param;
use EasySwoole\Http\Message\Status;
use EasySwoole\Validate\Validate;

/**
 * Class Confi
 * Create With Automatic Generator
 */
class Confi extends Base
{
	/**
	 * @api {get|post} /Admin/Confi/add
	 * @apiName add
	 * @apiGroup /Admin/Confi
	 * @apiPermission
	 * @apiDescription add新增数据
	 * @Param(name="id", alias="配置ID", required="", lengthMax="10")
	 * @Param(name="name", alias="配置名称", required="", lengthMax="100")
	 * @Param(name="value", alias="配置值", required="", lengthMax="")
	 * @Param(name="info", alias="描述", required="", lengthMax="255")
	 * @Param(name="module", alias="所属模块", required="", lengthMax="40")
	 * @Param(name="extend_value", alias="扩展值", required="", lengthMax="255")
	 * @Param(name="use_for", alias="用于", required="", lengthMax="32")
	 * @Param(name="status", alias="状态，1启用，0禁用", required="", lengthMax="2")
	 * @Param(name="sort_order", alias="排序", required="", lengthMax="5")
	 * @apiParam {int} id 配置ID
	 * @apiParam {string} name 配置名称
	 * @apiParam {string} value 配置值
	 * @apiParam {string} info 描述
	 * @apiParam {string} module 所属模块
	 * @apiParam {string} extend_value 扩展值
	 * @apiParam {string} use_for 用于
	 * @apiParam {int} status 状态，1启用，0禁用
	 * @apiParam {int} sort_order 排序
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
		    'name'=>$param['name'],
		    'value'=>$param['value'],
		    'info'=>$param['info'],
		    'module'=>$param['module'],
		    'extend_value'=>$param['extend_value'],
		    'use_for'=>$param['use_for'],
		    'status'=>$param['status']??'1',
		    'sort_order'=>$param['sort_order']??'0',
		];
		$model = new ConfiModel($data);
		$rs = $model->save();
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $model->toArray(), "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $model->lastQueryResult()->getLastError());
		}
	}


	/**
	 * @api {get|post} /Admin/Confi/update
	 * @apiName update
	 * @apiGroup /Admin/Confi
	 * @apiPermission
	 * @apiDescription update修改数据
	 * @Param(name="id", alias="配置ID", optional="", lengthMax="10")
	 * @Param(name="name", alias="配置名称", optional="", lengthMax="100")
	 * @Param(name="value", alias="配置值", optional="", lengthMax="")
	 * @Param(name="info", alias="描述", optional="", lengthMax="255")
	 * @Param(name="module", alias="所属模块", optional="", lengthMax="40")
	 * @Param(name="extend_value", alias="扩展值", optional="", lengthMax="255")
	 * @Param(name="use_for", alias="用于", optional="", lengthMax="32")
	 * @Param(name="status", alias="状态，1启用，0禁用", optional="", lengthMax="2")
	 * @Param(name="sort_order", alias="排序", optional="", lengthMax="5")
	 * @apiParam {int} id 主键id
	 * @apiParam {int} [id] 配置ID
	 * @apiParam {mixed} [name] 配置名称
	 * @apiParam {mixed} [value] 配置值
	 * @apiParam {mixed} [info] 描述
	 * @apiParam {mixed} [module] 所属模块
	 * @apiParam {mixed} [extend_value] 扩展值
	 * @apiParam {mixed} [use_for] 用于
	 * @apiParam {int} [status] 状态，1启用，0禁用
	 * @apiParam {int} [sort_order] 排序
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
		$model = new ConfiModel();
		$info = $model->get(['id' => $param['id']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['id'] = $param['id']??$info->id;
		$updateData['name'] = $param['name']??$info->name;
		$updateData['value'] = $param['value']??$info->value;
		$updateData['info'] = $param['info']??$info->info;
		$updateData['module'] = $param['module']??$info->module;
		$updateData['extend_value'] = $param['extend_value']??$info->extend_value;
		$updateData['use_for'] = $param['use_for']??$info->use_for;
		$updateData['status'] = $param['status']??$info->status;
		$updateData['sort_order'] = $param['sort_order']??$info->sort_order;
		$rs = $info->update($updateData);
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $rs, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $model->lastQueryResult()->getLastError());
		}
	}


	/**
	 * @api {get|post} /Admin/Confi/getOne
	 * @apiName getOne
	 * @apiGroup /Admin/Confi
	 * @apiPermission
	 * @apiDescription 根据主键获取一条信息
	 * @Param(name="id", alias="配置ID", optional="", lengthMax="10")
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
		$model = new ConfiModel();
		$bean = $model->get(['id' => $param['id']]);
		if ($bean) {
		    $this->writeJson(Status::CODE_OK, $bean, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}


	/**
	 * @api {get|post} /Admin/Confi/getAll
	 * @apiName getAll
	 * @apiGroup /Admin/Confi
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
		$model = new ConfiModel();
		$data = $model->getAll($page, $param['keyword']??null, $limit);
		$this->writeJson(Status::CODE_OK, $data, 'success');
	}


	/**
	 * @api {get|post} /Admin/Confi/delete
	 * @apiName delete
	 * @apiGroup /Admin/Confi
	 * @apiPermission
	 * @apiDescription 根据主键删除一条信息
	 * @Param(name="id", alias="配置ID", optional="", lengthMax="10")
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
		$model = new ConfiModel();

		$rs = $model->destroy(['id' => $param['id']]);
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, [], "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}
}

