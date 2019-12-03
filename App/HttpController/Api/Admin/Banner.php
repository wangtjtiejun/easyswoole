<?php

namespace App\HttpController\Api\Admin;

use App\HttpController\Base;
use App\Model\Admin\BannerModel;
use EasySwoole\Http\Annotation\Param;
use EasySwoole\Http\Message\Status;
use EasySwoole\Validate\Validate;

/**
 * Class Banner
 * Create With Automatic Generator
 */
class Banner extends Base
{
	/**
	 * @api {get|post} /Api/Admin/Banner/add
	 * @apiName add
	 * @apiGroup /Api/Admin/Banner
	 * @apiPermission
	 * @apiDescription add新增数据
	 * @Param(name="bannerId", alias="", required="", lengthMax="11")
	 * @Param(name="bannerName", alias="", required="", lengthMax="32")
	 * @Param(name="bannerImg", alias="banner图片", required="", lengthMax="255")
	 * @Param(name="bannerDescription", alias="", required="", lengthMax="255")
	 * @Param(name="bannerUrl", alias="跳转地址", required="", lengthMax="255")
	 * @Param(name="state", alias="状态0隐藏 1正常", required="", lengthMax="3")
	 * @apiParam {int} bannerId
	 * @apiParam {string} bannerName
	 * @apiParam {string} bannerImg banner图片
	 * @apiParam {string} bannerDescription
	 * @apiParam {string} bannerUrl 跳转地址
	 * @apiParam {int} state 状态0隐藏 1正常
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
		    'bannerId'=>$param['bannerId'],
		    'bannerName'=>$param['bannerName'],
		    'bannerImg'=>$param['bannerImg'],
		    'bannerDescription'=>$param['bannerDescription'],
		    'bannerUrl'=>$param['bannerUrl'],
		    'state'=>$param['state'],
		];
		$model = new BannerModel($data);
		$rs = $model->save();
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $model->toArray(), "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $model->lastQueryResult()->getLastError());
		}
	}


	/**
	 * @api {get|post} /Api/Admin/Banner/update
	 * @apiName update
	 * @apiGroup /Api/Admin/Banner
	 * @apiPermission
	 * @apiDescription update修改数据
	 * @Param(name="bannerId", alias="", optional="", lengthMax="11")
	 * @Param(name="bannerName", alias="", optional="", lengthMax="32")
	 * @Param(name="bannerImg", alias="banner图片", optional="", lengthMax="255")
	 * @Param(name="bannerDescription", alias="", optional="", lengthMax="255")
	 * @Param(name="bannerUrl", alias="跳转地址", optional="", lengthMax="255")
	 * @Param(name="state", alias="状态0隐藏 1正常", optional="", lengthMax="3")
	 * @apiParam {int} bannerId 主键id
	 * @apiParam {int} [bannerId]
	 * @apiParam {mixed} [bannerName]
	 * @apiParam {mixed} [bannerImg] banner图片
	 * @apiParam {mixed} [bannerDescription]
	 * @apiParam {mixed} [bannerUrl] 跳转地址
	 * @apiParam {int} [state] 状态0隐藏 1正常
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
		$model = new BannerModel();
		$info = $model->get(['bannerId' => $param['bannerId']]);
		if (empty($info)) {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], '该数据不存在');
		    return false;
		}
		$updateData = [];

		$updateData['bannerId'] = $param['bannerId']??$info->bannerId;
		$updateData['bannerName'] = $param['bannerName']??$info->bannerName;
		$updateData['bannerImg'] = $param['bannerImg']??$info->bannerImg;
		$updateData['bannerDescription'] = $param['bannerDescription']??$info->bannerDescription;
		$updateData['bannerUrl'] = $param['bannerUrl']??$info->bannerUrl;
		$updateData['state'] = $param['state']??$info->state;
		$rs = $info->update($updateData);
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, $rs, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], $model->lastQueryResult()->getLastError());
		}
	}


	/**
	 * @api {get|post} /Api/Admin/Banner/getOne
	 * @apiName getOne
	 * @apiGroup /Api/Admin/Banner
	 * @apiPermission
	 * @apiDescription 根据主键获取一条信息
	 * @Param(name="bannerId", alias="", optional="", lengthMax="11")
	 * @apiParam {int} bannerId 主键id
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
		$model = new BannerModel();
		$bean = $model->get(['bannerId' => $param['bannerId']]);
		if ($bean) {
		    $this->writeJson(Status::CODE_OK, $bean, "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}


	/**
	 * @api {get|post} /Api/Admin/Banner/getAll
	 * @apiName getAll
	 * @apiGroup /Api/Admin/Banner
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
		$model = new BannerModel();
		$data = $model->getAll($page, $param['keyword']??null, $limit);
		$this->writeJson(Status::CODE_OK, $data, 'success');
	}


	/**
	 * @api {get|post} /Api/Admin/Banner/delete
	 * @apiName delete
	 * @apiGroup /Api/Admin/Banner
	 * @apiPermission
	 * @apiDescription 根据主键删除一条信息
	 * @Param(name="bannerId", alias="", optional="", lengthMax="11")
	 * @apiParam {int} bannerId 主键id
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
		$model = new BannerModel();

		$rs = $model->destroy(['bannerId' => $param['bannerId']]);
		if ($rs) {
		    $this->writeJson(Status::CODE_OK, [], "success");
		} else {
		    $this->writeJson(Status::CODE_BAD_REQUEST, [], 'fail');
		}
	}
}

