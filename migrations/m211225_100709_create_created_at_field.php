<?php

use yii\db\Migration;

/**
 * Class m211225_100709_create_created_at_field
 */
class m211225_100709_create_created_at_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%problems}}', 'created_at', $this->timestamp());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%problems}}','created_at');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211225_100709_create_created_at_field cannot be reverted.\n";

        return false;
    }
    */
}
