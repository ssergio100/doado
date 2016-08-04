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
        $entity = new DMAccountEntity();
        $vo = $entity->getVO();
        dd($vo);
    }

}