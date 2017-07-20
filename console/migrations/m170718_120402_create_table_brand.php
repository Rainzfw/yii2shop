<?php

use yii\db\Migration;

class m170718_120402_create_table_brand extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170718_120402_create_table_brand cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if($this->db->driverName=='mysql'){
            $tableOptions = "character set utf8 collate utf8_general_ci engine=innodb comment='品牌表'";
        }
        $this->createTable('brand',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(20)->notNull()->comment('品牌名称'),
            'intro'=>$this->text()->comment('品牌介绍'),
            'logo'=>$this->string(200)->comment('品牌logo'),
            'sort'=>$this->smallInteger()->defaultValue(10)->comment('品牌排序'),
            'status'=>$this->smallInteger()->unsigned()->defaultValue(1)->comment('1正常2隐藏3删除')
        ],$tableOptions);
        $this->createIndex('namekey','brand','name',true);
        $this->createIndex('statuskey','brand','status');
    }

    public function down()
    {
        echo "m170718_120402_create_table_brand cannot be reverted.\n";

        return false;
    }

}
