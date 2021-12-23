<?php

use yii\db\Migration;

/**
 * Class m211223_072217_update_problem_field
 */
class m211223_072217_update_problem_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%problems}}', 'problem', 'content');
        $this->alterColumn('{{%problems}}', 'content', 'text');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%problems}}', 'content', 'problem');
        $this->alterColumn('{{%problems}}', 'problem', 'string');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211223_072217_update_problem_field cannot be reverted.\n";

        return false;
    }
    */
}
