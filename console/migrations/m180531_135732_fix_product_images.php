<?php

use common\models\db\ProductsImg;
use yii\db\Migration;

/**
 * Class m180531_135732_fix_product_images
 */
class m180531_135732_fix_product_images extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $images = ProductsImg::find()->all();
        foreach($images as $image){
            if($image['img'][0] !== '/')
                $image['img'] = '/'.$image['img'];
            if($image['img_thumb'][0] !== '/')
                $image['img_thumb'] = '/'.$image['img_thumb'];
            $image->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180531_135732_fix_product_images cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180531_135732_fix_product_images cannot be reverted.\n";

        return false;
    }
    */
}
