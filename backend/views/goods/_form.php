<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
\backend\assets\AppAsset::addCss($this,'@web/ztree-v3/css/zTreeStyle/zTreeStyle.css');
\backend\assets\AppAsset::addJs($this,'@web/ztree-v3/js/jquery.ztree.core.js');
\backend\assets\AppAsset::addJs($this,'@web/ztree-v3/js/jquery.ztree.excheck.js');

/* @var $this yii\web\View */
/* @var $model common\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="goods-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'logo')->hiddenInput(['id'=>'logo']) ?>

        <!--上传小部件主体-->
        <?php
            echo Html::fileInput('img',null,['id'=>'img']);
            echo \flyok666\uploadifive\Uploadifive::widget([
            'url' => yii\helpers\Url::to(['upload/s-upload']),//图片上传的地址
            'id' => 'img',//插件承载的主体
            'csrf' => true,//是否csrf验证
            'renderTag' => false,
            'jsOptions' => [
                'formData'=>['someKey' => 'someValue'],
                'width' => 120,//上传文件插件样式
                'height' => 40,
                //上传失败需要处理的
                'onError' => new \yii\web\JsExpression(<<<EOF
                    function(file, errorCode, errorMsg, errorString) {
                        console.log('The file ' + file.name + ' could not be uploaded: ' + errorString + errorCode + errorMsg);
                    }
EOF
                ),
                //上传完成需要处理的
                'onUploadComplete' => new \yii\web\JsExpression(<<<EOF
                    function(file, data, response) {
                        data = JSON.parse(data);
                        if (data.error) {
                            console.log(data.msg);
                        } else {
                            $('#logo').val(data.fileUrl);
                            if($('#img-logo')){
                                $('#img-logo').attr('src',data.fileUrl);
                            }else{
                                $('#logo').after('<img id="img-logo" src="'+data.fileUrl+'"/>');
                            }
                            console.log(data.fileUrl);
                        }
                    }
EOF
                    ),
                ]
            ]);
            if(!$model->isNewRecord && $model->logo){
                echo Html::img('http://img.yii2shop.cn'.$model->logo,['style'=>'width:80px;']);
            }
        ?>

        <?= $form->field($model, 'goods_cate_id')->hiddenInput(['maxlength' => true,'id'=>'goods_cate_id']) ?>
        <div>
            <ul id="treeDemo" class="ztree"></ul>
        </div>
        <?= $form->field($model, 'brand_id')->dropDownList(\yii\helpers\ArrayHelper::map(
            \common\models\Brand::find()->select(['id','name'])->where(['status'=>[1,2]])->all()
        ,'id','name'))?>

        <?= $form->field($model, 'shop_price')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'market_price')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'stock')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'is_on_sale')->radioList(\common\models\Goods::getIsonsale()) ?>

        <?= $form->field($model, 'status')->radioList(\common\models\Goods::getStatusarr()) ?>

        <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>
        <?= $form->field($goodsIntro, 'content')->widget('kucha\ueditor\UEditor',[
            'clientOptions' => [
                //编辑区域大小
                'initialFrameHeight' => '200',
                //设置语言
                'lang' =>'zh-cn', //中文为 zh-cn
                'serverUrl'=>\yii\helpers\Url::to(['upload/u-upload']),//图片上传的地址
                //定制菜单
                'toolbars' => [
                    [
                        'fullscreen', 'source', 'undo', 'redo', '|',
                        'fontsize',
                        'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat',
                        'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|',
                        'forecolor', 'backcolor', '|',
                        'lineheight', '|',
                        'indent', '|','simpleupload','insertimage', 'emotion', 'scrawl',
                    ],
                ]
            ]
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$zNodes = \common\models\GoodsCategory::getAlljson();
$nodeId = $model->goods_cate_id?$model->goods_cate_id:1;
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
         $.fn.zTree.init($("#treeDemo"), setting, {$zNodes});
         //默认选中节点
         var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
         //返回需要选中的节点
         var node = treeObj.getNodeByParam("id",{$nodeId}, null);
         if(node){
            //展开当前节点及其子节点
            treeObj.expandNode(node, true, true, true);
            //选中节点
            treeObj.selectNode(node);
         }
    });
    function zTreeOnCheck(event, treeId, treeNode) {
        //将选中的节点id保存在hidden里面
        $('#goods_cate_id').val(treeNode.id);
        console.log(treeNode);
    }
JS
));
?>