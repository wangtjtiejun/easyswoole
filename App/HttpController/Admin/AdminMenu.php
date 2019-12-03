<?php

namespace App\HttpController\Admin;

use App\HttpController\Base;
use App\Model\Admin\AdminMenuModel;
use EasySwoole\Http\Annotation\Param;
use EasySwoole\Http\Message\Status;
use EasySwoole\Validate\Validate;

/**
 * Class AdminMenu
 * Create With Automatic Generator
 */
class AdminMenu extends Base
{
	/**
	 * @api {get|post} /Admin/AdminMenu/add
	 * @apiName add
	 * @apiGroup /Admin/AdminMenu
	 * @apiPermission
	 * @apiDescription add新增数据
	 * @Param(name="id", alias="文档ID", required="", lengthMax="10")
	 * @Param(name="module", alias="", required="", lengthMax="20")
	 * @Param(name="pid", alias="上级分类ID", required="", lengthMax="10")
	 * @Param(name="title", alias="标题", required="", lengthMax="50")
	 * @Param(name="url", alias="链接地址", required="", lengthMax="255")
	 * @Param(name="icon", alias="", required="", lengthMax="64")
	 * @Param(name="sort_order", alias="排序（同级有效）", required="", lengthMax="10")
	 * @Param(name="type", alias="nav,auth", required="", lengthMax="40")
	 * @Param(name="status", alias="", required="", lengthMax="2")
	 * @apiParam {int} id 文档ID
	 * @apiParam {string} module
	 * @apiParam {int} pid 上级分类ID
	 * @apiParam {string} title 标题
	 * @apiParam {string} url 链接地址
	 * @apiParam {string} icon
	 * @apiParam {int} sort_order 排序（同级有效）
	 * @apiParam {string} type nav,auth
	 * @apiParam {int} status
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
		    'module'=>$param['module'],
		    'pid'=>$param['pid']??'0',
		    'title'=>$param['title'],
		    'url'=>$param['url'],
		    'icon'=>$param['icon'],
		    'sort_order'=>$param['sort_order']??'0',
		    'type'=>$param['type'],
		    'status'=>$param['status']??'1',
		];
		$model = new AdminMenuModel($data);
		$rs = $model->save();
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $model->toArray(), "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $model->lastQueryResult()->getLastError());
		}
	}


	/**
	 * @api {get|post} /Admin/AdminMenu/update
	 * @apiName update
	 * @apiGroup /Admin/AdminMenu
	 * @apiPermission
	 * @apiDescription update修改数据
	 * @Param(name="id", alias="文档ID", optional="", lengthMax="10")
	 * @Param(name="module", alias="", optional="", lengthMax="20")
	 * @Param(name="pid", alias="上级分类ID", optional="", lengthMax="10")
	 * @Param(name="title", alias="标题", optional="", lengthMax="50")
	 * @Param(name="url", alias="链接地址", optional="", lengthMax="255")
	 * @Param(name="icon", alias="", optional="", lengthMax="64")
	 * @Param(name="sort_order", alias="排序（同级有效）", optional="", lengthMax="10")
	 * @Param(name="type", alias="nav,auth", optional="", lengthMax="40")
	 * @Param(name="status", alias="", optional="", lengthMax="2")
	 * @apiParam {int} id 主键id
	 * @apiParam {int} [id] 文档ID
	 * @apiParam {mixed} [module]
	 * @apiParam {int} [pid] 上级分类ID
	 * @apiParam {mixed} [title] 标题
	 * @apiParam {mixed} [url] 链接地址
	 * @apiParam {mixed} [icon]
	 * @apiParam {int} [sort_order] 排序（同级有效）
	 * @apiParam {mixed} [type] nav,auth
	 * @apiParam {int} [status]
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
		$model = new AdminMenuModel();
		$info = $model->get(['id' => $param['id']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['id'] = $param['id']??$info->id;
		$updateData['module'] = $param['module']??$info->module;
		$updateData['pid'] = $param['pid']??$info->pid;
		$updateData['title'] = $param['title']??$info->title;
		$updateData['url'] = $param['url']??$info->url;
		$updateData['icon'] = $param['icon']??$info->icon;
		$updateData['sort_order'] = $param['sort_order']??$info->sort_order;
		$updateData['type'] = $param['type']??$info->type;
		$updateData['status'] = $param['status']??$info->status;
		$rs = $info->update($updateData);
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $rs, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $model->lastQueryResult()->getLastError());
		}
	}


	/**
	 * @api {get|post} /Admin/AdminMenu/getOne
	 * @apiName getOne
	 * @apiGroup /Admin/AdminMenu
	 * @apiPermission
	 * @apiDescription 根据主键获取一条信息
	 * @Param(name="id", alias="文档ID", optional="", lengthMax="10")
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
		$model = new AdminMenuModel();
		$bean = $model->get(['id' => $param['id']]);
		if ($bean) {
		    $this->writeJson(Status::CODE_OK, $bean, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}


	/**
	 * @api {get|post} /Admin/AdminMenu/getAll
	 * @apiName getAll
	 * @apiGroup /Admin/AdminMenu
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
		$model = new AdminMenuModel();
		$data = $model->getAll($page, $param['keyword']??null, $limit);
		$this->writeJson(Status::CODE_OK, $data, 'success');
	}


	/**
	 * @api {get|post} /Admin/AdminMenu/delete
	 * @apiName delete
	 * @apiGroup /Admin/AdminMenu
	 * @apiPermission
	 * @apiDescription 根据主键删除一条信息
	 * @Param(name="id", alias="文档ID", optional="", lengthMax="10")
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
		$model = new AdminMenuModel();

		$rs = $model->destroy(['id' => $param['id']]);
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, [], "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}
}

