<?php

use yii\db\Migration;

class m170722_060615_cerate_table_goods extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170722_060615_cerate_table_goods cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if($this->db->driverName=='mysql'){
            $tableOptions = "character set utf8 collate utf8_general_ci engine=innodb comment='商品'";
        }
        $this->createTable('goods',[
            'id'=>$this->primaryKey()->comment('商品id'),
            'sn'=>$this->string()->notNull()->comment('商品货号'),
            'name'=>$this->string(20)->notNull()->comment('商品名称'),
            'logo'=>$this->string(100)->notNull()->comment('商品logo'),
            'goods_cate_id'=>$this->integer()->unsigned()->notNull()->comment('商品分类id'),
            'brand_id'=>$this->integer()->unsigned()->notNull()->comment('品牌id'),
            'shop_price'=>$this->decimal(10,2)->notNull()->defaultValue(0)->comment('本店价格'),
            'market_price'=>$this->decimal(10,2)->notNull()->defaultValue(100)->comment('市场价格'),
            'stock'=>$this->integer()->unsigned()->notNull()->comment('库存'),
            'is_on_sale'=>$this->smallInteger()->notNull()->defaultValue(1)->comment('1上架2下架'),
            'status'=>$this->smallInteger()->notNull()->defaultValue(1)->comment('1正常2删除'),
            'sort'=>$this->integer()->unsigned()->notNull()->comment('排序'),
            'create_time'=>$this->integer()->unsigned()->defaultValue(0)->comment('添加时间')
        ],$tableOptions);

    }

    public function down()
    {
        echo "m170722_060615_cerate_table_goods cannot be reverted.\n";

        return false;
    }

}
