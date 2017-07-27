<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'sn',
            'name',
            [
                'attribute'=>'goods_cate_id',
                'value'=>'goodscategory.name',
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\GoodsCategory::find()->select(['id','name'])->orderBy('tree asc,lft asc')->all(),'id','name'),
            ],
            [
                'attribute'=>'brand_id',
                'value'=>'brand.name',
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\brand::find()->select(['id','name'])->all(),'id','name'),
            ],


            [
                'attribute'=>'is_on_sale',
                'value'=>'isonsaletext',
                'filter'=>\common\models\Goods::getIsonsale(),
                'contentOptions'=>function($model){
                    return $model->is_on_sale == 2 ? ['class'=>'bg-danger']:[];
                }
            ],
            [
                'attribute'=>'status',
                'value'=>'statustext',
                'filter'=>\common\models\Goods::getStatusarr(),
                'contentOptions'=>function($model){
                    return $model->status == 3 ? ['class'=>'bg-danger']:[];
                }
            ],
            [
                'attribute'=>'logo',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::img('http://img.yii2shop.cn'.$model->logo,['style'=>'width:60px']);
                },
            ],
            'market_price',
            'stock',
            'sort',
            'create_time:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{delete}{gallery}',
                'header' => '操作',
                'buttons'=>[
                    'delete'=>function($url,$model,$key){
                        $options=[
                            'title'=>Yii::t('yii','删除'),
                            'aria-label'=>Yii::t('yii','删除'),
                            'data-confirm'=>Yii::t('yii','你确定删除么?'),
                            'data-method'=>'post',
                            'data-pjax'=>'0',
                        ];
                        return Html::a("<span class='glyphicon glyphicon-trash'></span>",$url,$options);
                    },
                    'gallery'=>function($url,$model,$key){
                        $options=[
                            'title'=>Yii::t('yii','相册'),
                            'aria-label'=>Yii::t('yii','相册'),
                            'data-method'=>'get',
                            'data-pjax'=>'0',
                        ];
                        return Html::a("<span class='glyphicon glyphicon-picture'></span>",$url,$options);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
