<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '品牌管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-index">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加品牌', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'id',
                'contentOptions'=>['style'=>'width:38px']
            ],
            'name',
            [
                'attribute'=>'intro',
                'value'=>function($model){
                    if(mb_strlen($model->intro)>10){
                        return mb_substr($model->intro,0,10).'...';
                    }
                    return $model->intro.'...';
                }
            ],
            [
                'attribute'=>'logo',
                'value'=>function($model){
                    return Html::img('http://img.yii2shop.cn'.$model->logo,['style'=>'width:80px;']);
                },
                'format'=>'raw',
            ],
            [
                'attribute'=>'sort',
            ],
            [
                'attribute'=>'status',
                'value'=>'statustext',
                'filter'=>\common\models\Brand::getStatusarr(),
                'contentOptions'=>function($model){
                    return $model->status == 3 ? ['class'=>'bg-danger']:[];
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{delete}',
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
                ],
            ],
        ],
    ]); ?>
</div>
