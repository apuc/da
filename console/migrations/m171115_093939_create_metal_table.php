<?php

use yii\db\Migration;

/**
 * Handles the creation of table `metal`.
 */
class m171115_093939_create_metal_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('metal', [
            'id' => $this->primaryKey(),
            'name' => $this->string(2),
            'full_name' => $this->string(),

        ], $tableOptions);
        $this->insert('metal', [
            'id' => 1,
            'name' => 'Au',
            'full_name' => 'Золото',
        ]);
        $this->insert('metal', [
            'id' => 2,
            'name' => 'Ag',
            'full_name' => 'Серебро',
        ]);
        $this->insert('metal', [
            'id' => 3,
            'name' => 'Pt',
            'full_name' => 'Платина',
        ]);
        $this->insert('metal', [
            'id' => 4,
            'name' => 'Pd',
            'full_name' => 'Палладий',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('metal');
    }
}