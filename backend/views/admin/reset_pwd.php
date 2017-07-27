<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '添加';
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
echo \yii\widgets\DetailView::widget([
    'model' => $adminModel,
    'attributes' => [
        'id',
        'username',
        'email:email',
        [
            'attribute'=>'status',
            'value'=>function($model){
                return $model->statustext;
            }
        ],
        'created_at:datetime',
        'updated_at:datetime',
    ],
]);
?>
<div class="admin-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'old_password')->passwordInput()->label('旧密码');?>
    <?= $form->field($model, 'new_password1')->passwordInput()->label('新密码') ?>
    <?= $form->field($model, 'new_password2')->passwordInput()->label('确认新密码') ?>
    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>

