<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Menu;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'route')->textInput(['maxlength' => true]) ?>
    <?= Html::a('图标参考',' http://www.yeahzan.com/fa/facss.html')?>
    <?= $form->field($model, 'icon')->textInput() ?>
    <?= $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map(Menu::getMenus(),'id','nametext'));?>
    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

