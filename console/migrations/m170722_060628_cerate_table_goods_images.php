<?php

use yii\db\Migration;

class m170722_060628_cerate_table_goods_images extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170722_060628_cerate_table_goods_images cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if($this->db->driverName=='mysql'){
            $tableOptions = "character set utf8 collate utf8_general_ci engine=innodb comment='��Ʒ���'";
        }
        $this->createTable('goods_images',[
            'id'=>$this->primaryKey()->comment('ͼƬid'),
            'goods_id'=>$this->integer()->unsigned()->notNull()->comment('��Ʒid'),
            'img_url'=>$this->string(200)->comment('ͼƬ·��'),
        ],$tableOptions);
    }

    public function down()
    {
        echo "m170722_060628_cerate_table_goods_images cannot be reverted.\n";

        return false;
    }

}
