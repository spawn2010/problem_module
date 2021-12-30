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

        $this->addForeignKey(
            'fk-decision-problem_id',
            '{{%decisions}}',
            'problem_id',
            '{{%problems}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-decision-user_id',
            '{{%decisions}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-decision-problem_id',
            '{{%problems}}'
        );

        $this->dropForeignKey(
            'fk-decision-user_id',
            '{{%user}}'
        );

        $this->dropTable('{{%decisions}}');
    }
}
