<?php
/**
 * Created by PhpStorm.
 * User: wangtiejun
 * Date: 2019/11/13
 * Time: 17:15
 */
return [
	
	'view_replace_str'=>[
		'__STATIC__' =>  '/public',
		'__ROOT__' => '',
	],
	'dispatch_error_tmpl' => '/Views/Common/error.tpl',
	//默认成功跳转对应的模板文件
	'dispatch_success_tmpl' =>  '/Views/Common/success.tpl',	
	// 异常页面的模板文件
	'exception_tmpl'         =>  '/Views/Common/exception.tpl',
	
];

?>