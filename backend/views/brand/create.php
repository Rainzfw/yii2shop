<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Brand */

$this->title = '添加品牌';
$this->params['breadcrumbs'][] = ['label' => '品牌管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
