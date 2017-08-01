<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/29
 * Time: 8:52
 */

namespace backend\controllers;


use backend\models\Role;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class RoleController extends Controller
{
    public function actionCreate(){
        $model = new Role();
        if(\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())){
            $authManager = \Yii::$app->authManager;
            if($authManager->getRole($model->name)){
                throw new HttpException('角色['.$model->name.']已存在!');
            }
            $role = $authManager->createRole($model->name);
            $role->name=$model->name;
            $role->description=$model->description;
            $authManager->add($role);
            //绑定权限
            if(is_array($model->permissions)){
                foreach($model->permissions as $permission){
                    $permission = $authManager->getPermission($permission);
                    if($permission){
                        $authManager->addChild($role,$permission);
                    }
                }
            }
            \Yii::$app->session->setFlash('添加成功!');
            return $this->redirect(['index']);
        }
        return $this->render('create',['model'=>$model]);

    }
    public function actionUpdate($id){
        $model = new Role();
        $authManager = \Yii::$app->authManager;
        $role = $authManager->getRole($id);
        if(\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())){
            if($model->name !=$id && $authManager->getRole($model->name)){
                throw new HttpException('角色名称已存在!');
            }elseif($model->name!=$id){
                $role->name=$model->name;
            }
            $authManager->update($id,$role);
            //删除所有的权限
            $authManager->removeChildren($role);
            //绑定新的权限
            if(is_array($model->permissions)){
                foreach($model->permissions as $permission){
                    $permission = $authManager->getPermission($permission);
                    if($permission){
                        $authManager->addChild($role,$permission);
                    }
                }
            }
            \Yii::$app->session->setFlash('编辑成功!');
            return $this->redirect(['index']);
        }
        $model->loadRole($role);
        return $this->render('update',['model'=>$model]);
    }
    public function actionDelete($id){
        $authManager = \Yii::$app->authManager;
        $role = $authManager->getRole($id);
        if(!$role){
            throw new NotFoundHttpException('角色['.$id.']不存在');
        }
        $authManager->remove($role);
        \Yii::$app->session->setFlash('删除成功!');
        return $this->redirect(['index']);

    }
    public function actionIndex(){
        $provider = new ArrayDataProvider([
            'allModels' => \Yii::$app->authManager->getRoles(),
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);
        return $this->render('index',['dataProvider'=>$provider]);
    }

}