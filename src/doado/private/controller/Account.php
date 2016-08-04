<?php

/**
 * Created by PhpStorm.
 * User: marcelo
 * Date: 04/08/16
 * Time: 09:19
 */
class Account
{

    public function register(){

       $login = ARMNavigation::getVar('login');
       $password = ARMNavigation::getVar('password');
        if($login){
           return DMAccountModule::getInstance()->register();
        }

    }

}
