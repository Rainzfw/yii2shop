<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GoodsCategory */

$this->title = '添加';
$this->params['breadcrumbs'][] = ['label' => '商品分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-category-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
