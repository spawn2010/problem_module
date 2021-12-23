<?php

use yii\db\Migration;

/**
 * Class m211126_121441_update_user_status
 */
class m211126_121441_update_user_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%user}}', 'status', 'string');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%user}}', 'status', 'smallInteger');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211126_121441_update_user_status cannot be reverted.\n";

        return false;
    }
    */
}
