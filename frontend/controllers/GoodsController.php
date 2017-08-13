<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/5
 * Time: 10:39
 */

namespace frontend\controllers;


use common\models\Goods;
use common\models\GoodsCategory;
use common\models\GoodsGallery;
use yii\web\Controller;
use yii\web\HttpException;

class GoodsController extends Controller
{
    public function actionIndex(){
        $this->layout='index';
        $request = \Yii::$app->request;
        //页面总数
        $pageSize = 3;
        $gcid = $request->get('gcid');
        $query = Goods::find();
        if($gcid){
            $query->andWhere(['goods_cate_id'=>$gcid]);
        }
        //获取总条数
        $count = $query->count();
        //获取总页数
        $totalPage =ceil($count/$pageSize);
        //当前页数
        $currentPage = $request->get('currentPage')? $request->get('currentPage'):1;
        //验证当前页是否合法
        if($currentPage > $totalPage) $currentPage = $totalPage;
        if($currentPage < 0 ) $currentPage = 1;
        //当前页面数据
        $data = $query->limit($pageSize)->offset(($currentPage-1)*$pageSize)->asArray()->all();
        return $this->render('index',['data'=>$data,'gcid'=>$gcid,'totalPage'=>$totalPage,'currentPage'=>$currentPage]);
    }
    public function actionDetail($gid){
        $this->layout='index';
        //获取商品的信息
        $goodsinfo = Goods::findOne($gid);

        if(!$goodsinfo){
            throw new HttpException('商品['.$gid.']不存在');
        }
        //获取商品的照片
        $gallerys = GoodsGallery::findAll(['goods_id'=>$gid]);
        return $this->render('detail',['goodsinfo'=>$goodsinfo,'gallerys'=>$gallerys]);
    }

}