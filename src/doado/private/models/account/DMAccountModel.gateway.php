<?php
	/**
	* created by ARMModelGatewayMaker ( automated system ) 
	*
	* @date 04/08/2016 09:08:44 
	* @baseclass ARMBaseSingletonAbstract 
	*/
	class DMAccountModelGateway extends ARMBaseSingletonAbstract implements ARMModelGatewayInterface {
		/**
		* @return DMAccountModelGateway 
		*/
		public static function getInstance( $alias = "" ){
			return parent::getInstance( $alias ) ;
		}
		/**
		* @return DMAccountEntity
		*/
		function getEntity(){
			return new DMAccountEntity() ;
		}
		/**
		* @return DMAccountVO
		*/
		function getVO(){
			return new DMAccountVO() ;
		}
		/**
		* @return DMAccountDAO
		*/
		function getDAO( $alias = NULL ){
			//se nao foi enviado alias, tenta usar padrao
			if( ! $alias ){
				$default = DMAccountDAO::getDefaultInstance() ;
				if( $default ){
					return $default ;
				}
				//se não foi setado default, vai buscar a instance por nada
			}
			return DMAccountDAO::getInstance( $alias ) ;
		}
	}
		