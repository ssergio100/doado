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
        $vo = new DMAccountVO();
        $id = ARMNavigation::getVar('id');
        if($id){
            $resultado = $this->doUpdate();
            //dd($resultado);
            if($resultado->success){
                //ARMNavigation::redirect('');
                return $this->success();
                //self::success();
                //ARMNavigation::redirect(ARMNavigation::getLinkToController($this,"success",TRUE));
            }
        }

        if(ARMNavigation::getVar('edit')){
             $return =  DMAccountModelGateway::getInstance()->getDAO()->selectById(ARMNavigation::getVar('edit'));
            if($return->hasResult()){
                return $return->result[0];
            }

        }

        if(ARMNavigation::getVar('login')){
            $resultado = $this->doRegister();
            if($resultado->success){
                //ARMNavigation::redirect('');
                $this->success();
                //self::success();
                //ARMNavigation::redirect(ARMNavigation::getLinkToController($this,"success",TRUE));
            }
        }


    return $vo;
   }
    public function success(){
        ARMNavigation::redirect('account/listar');
    }

    public function doRegister(){
        $login       = ARMNavigation::getVar('login');
        $password    = ARMNavigation::getVar('password');
        return DMAccountModule::getInstance()->register($login,$password);
    }

    public function doUpdate(){
        $id       = ARMNavigation::getVar('id');
        $login       = ARMNavigation::getVar('login');
        $password    = ARMNavigation::getVar('password');
        return DMAccountModule::getInstance()->update($login,$password,$id);
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
        $result = new ARMReturnResultVO();
        $id = ARMNavigation::getVar('id');
        if($id) {
            //$result = new ARMReturnResultVO();
           // DMAccountModelGateway::getInstance()->getDAO()->selectById(ARMNavigation::getVar('id'));
           ARMNavigation::redirect("account/register/edit.$id");

        }else{
            /**/
        }

    }



}
