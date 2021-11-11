<?php

use yii\db\Migration;

/**
 * Class m211108_120643_user
 */
class m211108_120643_create_role_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    }

    public function up()
    {
        $this->addColumn('user', 'role', $this->string(64));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211108_120643_create_role_user cannot be reverted.\n";
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211108_120643_user cannot be reverted.\n";

        return false;
    }
    */
}
