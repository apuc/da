<?php

use common\models\db\Company;
use yii\db\Migration;

/**
 * Class m211102_083944_set_company_recomemended_null
 */
class m211102_083944_set_company_recommended_null extends Migration
{
    public function safeUp()
    {
        $this->update(Company::tableName(), ['recommended' => 0]);
    }

    public function safeDown()
    {
        echo "m211102_083944_set_company_recommended_null cannot be reverted.\n";
        return false;
    }
}
