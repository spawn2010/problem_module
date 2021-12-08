<?php

use yii\db\Migration;

/**
 * Class m211206_154009_user_image_field
 */
class m211206_154009_user_image_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'user_image', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','user_image');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211206_154009_user_image_field cannot be reverted.\n";

        return false;
    }
    */
}
