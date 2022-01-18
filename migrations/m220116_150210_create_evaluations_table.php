<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%evaluations}}`.
 */
class m220116_150210_create_evaluations_table extends Migration
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
        $this->createTable('{{%evaluations}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'decision_id' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-evaluation-decision_id',
            '{{%evaluations}}',
            'decision_id',
            '{{%decisions}}',
            'id',
            'CASCADE'
        );

         $this->addForeignKey(
            'fk-evaluation-user_id',
            '{{%evaluations}}',
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
        $this->dropTable('{{%evaluations}}');

        $this->dropForeignKey(
            'fk-evaluation-decision_id',
            '{{%decisions}}'
        );

        $this->dropForeignKey(
            'fk-evaluation-user_id',
            '{{%user}}'
        );
    }
}
