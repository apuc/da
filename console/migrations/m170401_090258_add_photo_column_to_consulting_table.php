<?php

use yii\db\Migration;

/**
 * Handles adding photo to table `consulting`.
 */
class m170401_090258_add_photo_column_to_consulting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('consulting', 'photo', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('consulting', 'photo');
    }
}
