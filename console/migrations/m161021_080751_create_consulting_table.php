<?php

use yii\db\Migration;

/**
 * Handles the creation for table `consulting`.
 */
class m161021_080751_create_consulting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('consulting', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(255)->notNull(),
            'descr'=>$this->text(),
            'dt_add'=>$this->integer(11),
            'dt_update'=>$this->integer(11),
            'slug'=>$this->string(255),
            'icon'=>$this->string(255),
            'views'=>$this->integer(11),
            'company_id'=>$this->integer(11)->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('consulting');
    }
}
