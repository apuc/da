<?php

use yii\db\Migration;

/**
 * Handles adding photo to table `poster`.
 */
class m161006_112923_add_photo_column_to_poster_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('poster', 'photo', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('poster', 'photo');
    }
}
