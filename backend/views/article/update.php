<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = '文章管理' . $amodel->name;
$this->params['breadcrumbs'][] = ['label' => '文章管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $amodel->name, 'url' => ['view', 'id' => $amodel->id]];
$this->params['breadcrumbs'][] = '编辑';
?>
<div class="article-update">
    <?= $this->render('_form', [
        'amodel' => $amodel,
        'admodel' => $admodel,
    ]) ?>

</div>
