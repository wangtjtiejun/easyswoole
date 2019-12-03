<?php

namespace App\Validate\Admin;

class Config
{
    
	function validate($data){
	
		$val = new \EasySwoole\Validate\Validate();
		
		$val->addColumn('name')->notEmpty('名称必填')->lengthMin('2','名称不能小于两位');
		$val->addColumn('value')->notEmpty('配置值必填');
		
		if(!$val->validate($data)){
			return ['error'=>$val->getError()->__toString()];
		}
		
	}
	
}