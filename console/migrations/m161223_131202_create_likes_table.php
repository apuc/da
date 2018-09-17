<?php

use yii\db\Migration;

/**
 * Handles the creation for table `likes`.
 */
class m161223_131202_create_likes_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable( 'likes', [
            'id'        => $this->primaryKey(),
            'post_type' => $this->string( 64 ),
            'post_id'   => $this->integer( 11 ),
            'user_id'   => $this->integer( 11 ),
            'dt_add'    => $this->integer( 11 ),
        ] );
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable( 'likes' );
    }
}
