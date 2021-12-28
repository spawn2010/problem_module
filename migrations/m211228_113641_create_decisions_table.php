<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%decisions}}`.
 */
class m211228_113641_create_decisions_table extends Migration
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
        $this->createTable('{{%decisions}}', [
            'id' => $this->primaryKey(),
            'problem_id' => $this->integer(),
            'user_id' => $this->integer(),
            'content' => $this->text(),
            'created_at' => $this->timestamp()->defaultValue(new Expression('NOW()')),
        ], $tableOptions);
        $this->execute('INSERT INTO decisions (problem_id, user_id, content) SELECT id, user_id, decision FROM problems WHERE decision !=""');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%decisions}}');
    }
}
