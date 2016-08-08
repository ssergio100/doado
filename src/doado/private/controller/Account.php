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
           if(ARMNavigation::getVar('id')){
               $id = ARMNavigation::getVar('id');
           }else{
               $id = NULL;
           }
               $resultado = $this->doRegister($id);


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
        ARMNavigation::redirect('account/listar');
    }

    public function doRegister($id){
        $login       = ARMNavigation::getVar('login');
        $password    = ARMNavigation::getVar('password');
        return DMAccountModule::getInstance()->register($login,$password,$id);
    }

    public function listar(){
        //$result = new ARMReturnResultVO();
        return DMAccountModelGateway::getInstance()->getDAO()->selectAll();
        //$result->result = $returnData->result;
        //dd($resultData);
        //return $result;
    }
    public function delete(){
        if(ARMNavigation::getVar('id')){
        DMAccountModule::getInstance()->delete(ARMNavigation::getVar('id'));
        ARMNavigation::redirect('account/listar');
        }else{
            /**/
        }
    }

    public function active(){
        if(ARMNavigation::getVar('id')) {
            DMAccountModule::getInstance()->active(ARMNavigation::getVar('id'));
            ARMNavigation::redirect('account/listar');
        }else{
            /**/
        }

    }
    public function reset(){
        if(ARMNavigation::getVar('id')) {
            DMAccountModule::getInstance()->reset(ARMNavigation::getVar('id'));
            ARMNavigation::redirect('account/listar');
        }else{
            /**/
        }

    }
    public function edit(){
        if(ARMNavigation::getVar('id')) {
            //$result = new ARMReturnResultVO();
            $returnData = DMAccountModelGateway::getInstance()->getDAO()->selectById(ARMNavigation::getVar('id'));
            return $returnData;
            ARMNavigation::redirect('account/register');

        }else{
            /**/
        }

    }



}
