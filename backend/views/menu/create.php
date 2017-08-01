<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Menu */

$this->title = '添加';
$this->params['breadcrumbs'][] = ['label' => '菜单管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
