<?php
/**
 * created by ARMModelVoMaker ( automated system )
 * 
 * @date 04/08/2016 09:08:44
 * @from_table account 
 */ 
class DMAccountVO extends ARMAutoParseAbstract{
	
	 
	
	/**
	 * @type : int(10) unsigned			
	 */
	public $id;
	
	/**
	 * @type : int(1)			
	 */
	public $active;
	
	/**
	 * @type : varchar(255)			
	 */
	public $login;
	
	/**
	 * @type : varchar(255)			
	 */
	public $password;
	
	/**
	 * @type : varchar(255)			
	 */
	public $facebook_id;
}
	