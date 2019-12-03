<?php

namespace App\Validate\Admin;

class Admin
{
    
	function validate($data){
		
		$val = new \EasySwoole\Validate\Validate();
		
		$val->addColumn('user_name')->notEmpty('用户名必填')->lengthMin('2','用户名不能小于两位');
		$val->addColumn('passwd')->notEmpty('密码必填')->lengthMin('6','密码不能小于六位');
		$val->addColumn('group_id')->notEmpty('请先在权限管理添加用户组');

		if(!$val->validate($data)){
			return ['error'=>$val->getError()->__toString()];
		}
		
	}
	function pwd($data){
		
		$val = new \EasySwoole\Validate\Validate();		
		
		$val->addColumn('passwd')->notEmpty('密码必填')->lengthMin('6','密码不能小于六位');
		$val->addColumn('passwd2')->notEmpty('确认密码必填')->lengthMin('6','密码不能小于六位')->equal($data['passwd'],'两次密码不一样');
		

		if(!$val->validate($data)){
			return ['error'=>$val->getError()->__toString()];
		}
		
	}
}