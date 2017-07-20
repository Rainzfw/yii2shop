<?php

use yii\db\Migration;

class m170719_063125_create_table_article extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170719_063125_create_table_article cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if($this->db->driverName=='mysql'){
            $tableOptions = "character set utf8 collate utf8_general_ci engine=innodb comment='文章表'";
        }
        $this->createTable('article',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(20)->notNull()->comment('文名称'),
            'article_category_id'=>$this->integer()->unsigned()->defaultValue(1)->comment('文章分类id'),
            'sort'=>$this->smallInteger()->unsigned()->defaultValue(10)->comment('文章分类排序'),
            'status'=>$this->smallInteger()->defaultValue(1)->comment('1正常,2隐藏,3删除'),
            'create'=>$this->integer()->defaultValue(0)->comment('添加时间')
        ],$tableOptions);
        $this->createIndex('namekey','article','name',true);
        $this->createIndex('statuskey','article','status');

    }

    public function down()
    {
        echo "m170719_063125_create_table_article cannot be reverted.\n";

        return false;
    }

}
