<?php
/**
* created by ARMModuleMaker ( automated system )
* ! Please, don't change this file
* insted change DMAccountModule class
*
* ARMBaseDMAccountModuleAbstract
* @date 04/08/2016 09:08:44
*/

abstract class ARMBaseDMAccountModuleAbstract extends ARMBaseDataModuleAbstract {
	/**
	 * @return DMAccountModelGateway
	 */
	function getModelGateway() {
		return DMAccountModelGateway::getInstance() ;
	}

	/**
	 * @param string $alias
	 * @param bool $useDefaultIfNotFound
	 * @return DMAccountModule
	 */
	public static function getInstance($alias = self::DEFAULT_GLOBAL_ALIAS, $useDefaultIfNotFound = FALSE) {
		return parent::getInstance( $alias, $useDefaultIfNotFound) ;
	}

	/**
	 * @param $id
	 * @return DMAccountModelGateway
	 */
	public function getEntityById( $id ) {
		return parent::getEntityById( $id ) ;
	}

	/**
	 * Aviso: Não retorna a VO e sim a "Entity"->toStdClass() (que pode conter mais propriedades )
	 * @param $id
	 * @return DMAccountVO
	 */
	public function getStdById( $id ) {
		return parent::getStdById( $id ) ;
	}
}