<?php

namespace backend\controllers;

use common\models\GoodsDayCount;
use common\models\GoodsGallery;
use common\models\GoodsImages;
use common\models\GoodsIntro;
use Yii;
use common\models\Goods;
use backend\models\GoodsSearch;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $goodsIntro = Goods::findOne($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'goodsIntro'=>$goodsIntro
        ]);
    }

    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $goodsModel = new Goods();
        $goodsIntro = new GoodsIntro();
        if(Yii::$app->request->isPost){
            //开启事务机制
            $tr = Yii::$app->db->beginTransaction();
            try{
                //判断是否需要创建新的daymodel
                if(!$dayModel = GoodsDayCount::findOne(date('Ymd',time()))){
                    $dayModel = new GoodsDayCount();
                    $dayModel->day=date('Ymd',time());
                    $dayModel->count = 1;
                }else{
                    $dayModel->count += 1;
                }
                $goodsModel->sn = $dayModel->day.str_pad($dayModel->count,6,'0',STR_PAD_LEFT);

                if(!$goodsModel->load(Yii::$app->request->post()) || !$goodsModel->save() || !$dayModel->save()){
                    throw new Exception('添加商品表失败!');
                }
                $goodsIntro->goods_id = $goodsModel->id;
                if (!$goodsIntro->save()) {
                    throw new Exception('添加商品详情表失败!');

                }
                $tr->commit();
                return $this->redirect(['view', 'id' => $goodsModel->id]);
            }catch (Exception $e){
                $tr->rollBack();
                throw new HttpException($e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $goodsModel,
            'goodsIntro'=>$goodsIntro,
        ]);
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $goodsIntro = GoodsIntro::findOne($id);
        if(Yii::$app->request->isPost){
            //开启事务机制
            $tr = Yii::$app->db->beginTransaction();
            try{
                //修改商品表
                if(!$model->load(Yii::$app->request->post()) || !$model->save()){
                    throw new Exception('修改商品表失败!');
                }
                if(!$goodsIntro->load(Yii::$app->request->post()) || !$goodsIntro->save()){
                    throw new Exception('修改商品详情表失败!');
                }
                $tr->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            }catch (Exception $e){
                $tr->rollBack();
                throw new HttpException($e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $model,
            'goodsIntro'=>$goodsIntro,
        ]);

    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    //获取商品相册
    public function actionGallery($id){
        $query = GoodsGallery::find()->where(['goods_id'=>$id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('gallery',['dataProvider'=>$dataProvider,'goods_id'=>$id]);
    }
    //删除照片
    public function actionGalleryDelete($id){
        $goodsGallery = GoodsGallery::findOne($id);
        if(!$goodsGallery){
            throw new NotFoundHttpException('没有图片'.$id);
        }
        $goodsGallery->delete();
        return $this->redirect(['gallery','id'=>$goodsGallery->goods_id]);
    }
}
