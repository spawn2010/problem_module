<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%problems}}`.
 */
class m210818_184246_create_problems_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%problems}}', [
            'id' => $this->primaryKey(),
            'problem' => $this->string()->notNull(),
            'decision' => $this->string()->notNull(),
            'rating' => $this->string()

        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%problems}}');
    }
}
