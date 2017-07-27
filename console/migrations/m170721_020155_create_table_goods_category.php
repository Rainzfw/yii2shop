<?php

use yii\db\Migration;

class m170721_020155_create_table_goods_category extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170721_020155_create_table_goods_category cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if($this->db->driverName=='mysql'){
            $tableOptions = "character set utf8 collate utf8_general_ci engine=innodb comment='商品分类'";
        }
        $this->createTable('goods_category',[
            'id'=>$this->primaryKey()->comment('分类id'),
            'parent_id'=>$this->integer()->unsigned()->notNull()->comment('上级分类'),
            'name'=>$this->string(20)->comment('商品分类名称'),
            'intro'=>$this->string(200)->comment('商品分类介绍'),
            'tree'=>$this->integer()->unsigned()->notNull()->defaultValue(0)->comment('树id'),
            'lft'=>$this->integer()->unsigned()->notNull()->comment('左边界的值'),
            'rgt'=>$this->integer()->unsigned()->notNull()->comment('右边界的值'),
            'depth'=>$this->integer()->unsigned()->comment('层级'),
            'status'=>$this->smallInteger()->unsigned()->defaultValue(1)->comment('1正常2隐藏3正常'),
            'create_time'=>$this->integer()->notNull()->defaultValue(0)->comment('添加时间')
        ],$tableOptions);
    }

    public function down()
    {
        echo "m170721_020155_create_table_goods_category cannot be reverted.\n";

        return false;
    }

}
