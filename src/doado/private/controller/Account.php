<?php

/**
 * Created by PhpStorm.
 * User: marcelo
 * Date: 04/08/16
 * Time: 09:19
 */
class Account 
{
    /**
     *
     * @return ARMReturnResultVO
     */
      public function register(){


       if(ARMNavigation::getVar('login')){
          //return DMAccountModule::getInstance()->register($login,$password);
           $resultado = $this->doRegister();

           if($resultado->success){
               //ARMNavigation::redirect('');
               $this->success();
               //self::success();
               //ARMNavigation::redirect(ARMNavigation::getLinkToController($this,"success",TRUE));
           }else{
               return $resultado;
           }
        }
        //dd($res);
   }
    public function success(){
        ARMNavigation::redirect('success');
    }

    public function doRegister(){
        $login       = ARMNavigation::getVar('login');
        $password    = ARMNavigation::getVar('password');
        return DMAccountModule::getInstance()->register($login,$password);
    }

    public function listar(){
        //$result = new ARMReturnResultVO();
        return DMAccountModelGateway::getInstance()->getDAO()->selectAll();
        //$result->result = $returnData->result;
        //dd($resultData);
        //return $result;
    }


}
