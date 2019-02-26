<?php
    namespace c;           //命名空间是 c
    use \z\controller;     //导入controller类
    class manage extends controller{             //定义index控制器继承controller类
        static function index(){               //index操作
            $where  =  array();
            $m = M('users');
            $result = $m->getusers($where);
            if($result){
                parent::assign('users',$result);
                parent::display();
            }else{
                echo fail;
            }
        }

//        static function getusers(){
//            $where  =  array();
//            $m = M('users');
//            $result = $m->getusers($where);
//            if($result){
//                 var_dump($result);
//            }else{
//                echo fail;
//            }
//        }

        static function addusers(){
            $user['name'] = '修改用户名se';
            $user['password'] = md5('登陆密码');
            $m = M('users');
            $result = $m->addusers($user);
            if($result){
                parent::error($result);
            }else{
                parent::success();
            }
        }
        static function editusers(){
            $where['uid'] = I('uid');
            if(!$where['uid']){
                return '缺少参数:uid';
            }
            $user['name'] = '修改用户名';
            $user['password'] = md5('修改登陆密码');
            $m = M('users');
            $result = $m->editusers($where,$user);
            if($result){
                parent::error($result);
            }else{
                parent::success();
            }
        }
    }