<?php

use yii\db\Migration;

/**
 * Class m190705_112712_add_table_category_sima_land
 */
class m190705_112712_add_table_category_sima_land extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sima_categories',[
            'id' => $this->primaryKey(),
            'sima_id' => $this->integer(11),
            'sid' => $this->integer(11),
            'name' => $this->string(256),
            'priority' => $this->integer(11),
            'priority_home' => $this->integer(11),
            'priority_menu' => $this->integer(11),
            'is_hidden_in_menu' => $this->integer(11),
            'path' => $this->string(256),
            'level' => $this->integer(11),
            'type' => $this->integer(11),
            'is_adult' => $this->integer(11),
            'has_loco_slider' => $this->boolean()->defaultValue(false),
            'has_design' => $this->boolean()->defaultValue(false),
            'has_as_main_design' => $this->boolean()->defaultValue(false),
            'is_item_description_hidden' => $this->boolean()->defaultValue(false),
            'is_for_mobile_app' => $this->boolean()->defaultValue(false),
            'category_group_id' => $this->integer(11)->defaultValue(null),
            'photo' => $this->string(256)->defaultValue(null),
            'icon' => $this->string(256)->defaultValue(null),
            'is_leaf' => $this->integer(11)->defaultValue(null),
            'full_slug' => $this->string(256)->defaultValue(null),
            'upper_text' => $this->string(256)->defaultValue(null),
            'h2_title' => $this->string(256)->defaultValue(null),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sima_categories');
    }


}
