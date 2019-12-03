<?php

namespace App\Validate\Admin;

class Auth
{
    
	function create_group($data){
		
		$val = new \EasySwoole\Validate\Validate();
		
		$val->addColumn('title')->notEmpty('用户组必填')->lengthMin('2','用户组不能小于两位');
		

		if(!$val->validate($data)){
			return ['error'=>$val->getError()->__toString()];
		}
		
	}
	
}