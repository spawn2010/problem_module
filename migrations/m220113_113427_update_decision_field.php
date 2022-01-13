<?php

use yii\db\Migration;

/**
 * Class m220113_113427_update_decision_field
 */
class m220113_113427_update_decision_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%problems}}', 'decision');
        $this->addColumn('{{%problems}}', 'decision', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%problems}}', 'decision', 'string');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220113_113427_update_decision_field cannot be reverted.\n";

        return false;
    }
    */
}
