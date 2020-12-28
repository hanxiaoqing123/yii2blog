<?php


namespace backend\controllers;

use Yii;

class RbacController extends \yii\web\Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        //添加权限：/blog/index
        $blogIndex = $auth->createPermission('/blog/index');
        $blogIndex->description = '博客列表';
        $auth->add($blogIndex);
        //创建角色：博客管理，并为该角色分配/blog/index权限
        $blogManage = $auth->createRole('博客管理');
        $auth->add($blogManage);
        $auth->addChild($blogManage, $blogIndex);
        //为用户test1分配角色"博客管理"权限
        $auth->assign($blogManage, 1);
    }

    //添加权限
    public function actionInit2()
    {
        $auth = Yii::$app->authManager;
        $blogView = $auth->createPermission('/blog/view');
        $auth->add($blogView);
        $blogCreate = $auth->createPermission('/blog/create');
        $auth->add($blogCreate);
        $blogUpdate = $auth->createPermission('/blog/update');
        $auth->add($blogUpdate);
        $blogDelete = $auth->createPermission('/blog/delete');
        $auth->add($blogDelete);
        //分配给我们已经添加过的"博客管理"权限
        $blogManage = $auth->getRole('博客管理');
        $auth->addChild($blogManage, $blogView);
        $auth->addChild($blogManage, $blogCreate);
        $auth->addChild($blogManage, $blogUpdate);
        $auth->addChild($blogManage, $blogDelete);
    }

}