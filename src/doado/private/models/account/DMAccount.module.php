<?php
	/**
	* created by ARMModuleMaker ( automated system )
	* Please, change this file
	* don't change ARMBaseDMAccountModuleAbstract class
	*
	* ARMBaseDMAccountModuleAbstract
	* @date 04/08/2016 09:08:44
	*/

class DMAccountModule extends ARMBaseDMAccountModuleAbstract {
	//put your changes and rewrited methods here
	//Good developers always comment theirs code

	public function register($login, $password){
		//$retorno = new ARMReturnResultVO();
		$entity = DMAccountModelGateway::getInstance()->getEntity();
		$vo = $entity->getVO();
		$vo->login = $login;
		$vo->password = $password;
		$entity->fetchObject($vo);
		$res = $entity->commit();
		return $res;
	}
}