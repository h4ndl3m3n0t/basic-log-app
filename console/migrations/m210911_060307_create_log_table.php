<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m210911_060307_create_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%log}}', [
            'log_id' => $this->string(512),
            'title' => $this->string(200),
            'body' => $this->text()->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
        ]);

        $this->addPrimaryKey('PK_log_id', '{{%log}}', 'log_id');

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-log-created_by}}',
            '{{%log}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-log-created_by}}',
            '{{%log}}',
            'created_by',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-log-created_by}}',
            '{{%log}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-log-created_by}}',
            '{{%log}}'
        );

        $this->dropTable('{{%log}}');
    }
}
