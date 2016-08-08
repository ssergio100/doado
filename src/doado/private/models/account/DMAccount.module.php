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

	public function register($login, $password,$id){
		//$retorno = new ARMReturnResultVO();
		if($id){
			$sql = "UPDATE account SET password = '$password',login='$login',Active=0 WHERE id = $id";
			$res = DMAccountModelGateway::getInstance()->getDAO()->query($sql);
		}else {
			$entity = DMAccountModelGateway::getInstance()->getEntity();
			$vo = $entity->getVO();
			$vo->login = $login;
			$vo->password = $password;
			$entity->fetchObject($vo);
			$res = $entity->commit();
			$ref_id = ($res->result->id)?$res->result->id:NULL;
			$this->log($ref_id);

		}
		return $res;
	}
	public function delete($id){
		DMAccountModelGateway::getInstance()->getDAO()->delete($id);

	}
	public function active($id){
		$resultData = DMAccountModelGateway::getInstance()->getDAO()->selectById($id);
		$active = ($resultData->result[0]->active) ? 0 : 1;
		$sql = "UPDATE account SET active = $active WHERE id = $id ";
		DMAccountModelGateway::getInstance()->getDAO()->query($sql);

	}
	public function reset($id){

		$sql = "UPDATE account SET password = '1234' WHERE id = $id";
		DMAccountModelGateway::getInstance()->getDAO()->query($sql);

	}

	public function log($ref_id = NULL){
		$log = new ARMLogInfoVO();
		$log->action = "doSomething";
		$log->action_label = __CLASS__."::".__METHOD__;
		$log->ref_alias = "something";
		$log->ref_id = $ref_id;
		$log->user_id = 0;
		ARMLogModule::getInstance('account')->addLog($log);
	}
}