<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-view">

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sn',
            'name',
            'shop_price',
            'market_price',
            'stock',
            [
                'attribute'=>'logo',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::img(Yii::$app->params['imgUrl'].$model->logo,['style'=>'width:80px;']);
                }

            ],
            [
                'attribute'=>'goods_cate_id',
                'value'=>function($model){
                    return $model->goodscategory?$model->goodscategory->name:'未知';
                }

            ],
            [
                'attribute'=>'brand_id',
                'value'=>function($model){
                    return $model->brand?$model->brand->name:'未知';
                }

            ],
            [
                'attribute'=>'status',
                'value'=>function($model){
                    return $model->statustext;
                }

            ],
            'sort',
            [
                'attribute'=>'content',
                'value'=>function($model){
                    return $model->goodsintro?$model->goodsintro->content:'未知';
                }

            ],
            'create_time:datetime',
        ],
    ]) ?>

</div>
