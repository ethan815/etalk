<?php
namespace m;
use \z\db;
class users extends db{

    function getusers($where){
        $result = $this->where($where)->select();
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    function getuser($where){
        $result = $this->where($where)->find();
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    function addusers($user){
        $result = $this->add($user);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    function editusers($where,$user){
        if(!$where['uid']){
            return 'È±ÉÙ²ÎÊı:uid';
        }
        $result = $this->where($where)->save($user);
        if($result){
            return true;
        }else{
            return false;
        }
    }
}