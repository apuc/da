<?php

use yii\db\Migration;

/**
 * Class m180409_124550_tw_id_range_fix
 */
class m180409_124550_tw_id_range_fix extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->alterColumn('tw_pages', 'tw_id', 'VARCHAR(32) NULL DEFAULT NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->alterColumn('tw_pages', 'tw_id', 'INT(11) NULL DEFAULT NULL');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180409_124550_tw_id_range_fix cannot be reverted.\n";

        return false;
    }
    */
}
