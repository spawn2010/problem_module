<?php

use yii\db\Migration;

/**
 * Class m211126_141756_user_id_field
 */
class m211126_141756_user_id_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('problems', 'user_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('problems','user_id');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211126_141756_user_id_field cannot be reverted.\n";

        return false;
    }
    */
}
