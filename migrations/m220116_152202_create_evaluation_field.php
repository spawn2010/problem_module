<?php

use yii\db\Migration;

/**
 * Class m220116_152202_create_evaluation_field
 */
class m220116_152202_create_evaluation_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%decisions}}', 'evaluation', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%decisions}}','evaluation');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220116_152202_create_evaluation_field cannot be reverted.\n";

        return false;
    }
    */
}
