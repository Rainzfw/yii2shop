<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Brand */

$this->title = '编辑' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '品牌管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '编辑';
?>
<div class="brand-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
