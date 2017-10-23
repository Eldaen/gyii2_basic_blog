<?php

use yii\db\Migration;

/**
 * Handles the creation of table `calendar`.
 */
class m171019_175737_create_task_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'date' => $this->integer(11)->notNull(),
            'description' => $this->text(),
            'fk_user_id' => $this->integer(11)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);

        $this->addForeignKey('fk_calendar_user', 'task', 'fk_user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_calendar_user', 'task');
        $this->dropTable('task');
    }
}
