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

       $login       = ARMNavigation::getVar('login');
       $password    = ARMNavigation::getVar('password');
       if($login && $password){
          return DMAccountModule::getInstance()->register();
        }else{
           $vo = new ARMReturnResultVO();
           $vo->success = false;
           $vo->addMessage('Todos os campos devem ser preenchidos!');
           return d($vo->toJson());
       }

   }
    public  function  login(){
        $vo = new ARMReturnResultVO();
        $vo->success = true;
        $vo->Message = "Cristo do ceu!!";
        $vo->result = "Resultado ok";
        $vo->array_messages= array("m1"=>"menagem1","m2"=>"menagem2","m3"=>"menagem3");
        dd($vo->toJson());
    }
    
    public  function  logout(){

    }
    
    public  function  resset(){

    }

}
