<?php

use yii\db\Migration;

class m170719_063134_create_table_article_detail extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170719_063134_create_table_article_detail cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if($this->db->driverName=='mysql'){
            $tableOptions = "character set utf8 collate utf8_general_ci engine=innodb comment='文章详情表'";
        }
        $this->createTable('article_detail',[
            'article_id'=>$this->primaryKey()->comment('文章id'),
            'content'=>$this->text()->notNull()->comment('文章内容'),
        ],$tableOptions);

    }

    public function down()
    {
        echo "m170719_063134_create_table_article_detail cannot be reverted.\n";

        return false;
    }

}
