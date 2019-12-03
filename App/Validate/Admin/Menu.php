<?php

namespace App\Validate\Admin;

class Menu
{
    
	function validate($data){
		
		$val = new \EasySwoole\Validate\Validate();
		
		$val->addColumn('title')->required('菜单名称必填')->lengthMin(2,'菜单名称最小长度不小于2位');
			
		if(!$val->validate($data)){
			return ['error'=>$val->getError()->__toString()];
		}
		
	}
	
}