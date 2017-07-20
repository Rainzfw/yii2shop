<?php

use yii\db\Migration;

class m170718_121956_create_table_article_category extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170718_121956_create_table_article_category cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if($this->db->driverName=='mysql'){
            $tableOptions = "character set utf8 collate utf8_general_ci engine=innodb comment='文章分类表'";
        }
        $this->createTable('article_category',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(20)->notNull()->comment('文章分类名称'),
            'intro'=>$this->string(300)->comment('文章分类介绍'),
            'sort'=>$this->smallInteger()->unsigned()->defaultValue(10)->comment('文章分类排序'),
            'status'=>$this->smallInteger()->defaultValue(1)->comment('1正常,2隐藏,3删除'),
            'is_help'=>$this->smallInteger()->defaultValue(0)->comment('0否1是')
        ],$tableOptions);
        $this->createIndex('namekey','article_category','name',true);
        $this->createIndex('ishelpkey','article_category','is_help');
        $this->createIndex('statuskey','article_category','status');

    }

    public function down()
    {
        echo "m170718_121956_create_table_article_category cannot be reverted.\n";

        return false;
    }

}
