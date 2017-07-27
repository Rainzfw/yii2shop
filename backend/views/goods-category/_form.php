<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GoodsCategory */
/* @var $form yii\widgets\ActiveForm */
//添加静态资源ztree
\backend\assets\AppAsset::addCss($this,'@web/ztree-v3/css/zTreeStyle/zTreeStyle.css');
\backend\assets\AppAsset::addJs($this,'@web/ztree-v3/js/jquery.ztree.core.js');
\backend\assets\AppAsset::addJs($this,'@web/ztree-v3/js/jquery.ztree.excheck.js');
?>

<div class="goods-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'intro')->textInput(['maxlength' => true]) ?>
    <?=$form->field($model,'parent_id')->hiddenInput(['id'=>'parent_id'])?>
    <div>
        <ul id="treeDemo" class="ztree"></ul>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
    $zNodes = \common\models\GoodsCategory::getAlljson();
    $id = $model->parent_id?$model->parent_id:0;
    $this->registerJs(new \yii\web\JsExpression(<<<JS
    var setting = {
        check: {
            enable: true,
            chkStyle: "radio",
            radioType: "all"//同一级类level 还是整颗树all 默认是整颗树
        },
        data: {
            simpleData: {
                enable: true,
                idKey: "id",
                pIdKey: "parent_id",
                rootPId: 0
            }
        },
        callback: {
		    onCheck: zTreeOnCheck
	    }
    };
    $(document).ready(function(){
         $.fn.zTree.init($("#treeDemo"), setting, $zNodes);
         //默认选中节点
         var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
         //返回需要选中的节点
         var node = treeObj.getNodeByParam("id",$id, null);
         if(node){
            //展开当前节点及其子节点
            treeObj.expandNode(node, true, true, true);
            //选中节点
            treeObj.selectNode(node);
         }
    });
    function zTreeOnCheck(event, treeId, treeNode) {
        //将选中的节点id保存在hidden里面
        $('#parent_id').val(treeNode.id);
        console.log(treeNode);
    }
JS
    ));
?>