<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blogEntry`.
 */
class m171016_152315_create_blogEntry_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('blogEntry', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'body' => $this->binary(),
            'user_id' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('blogEntry');
    }
}
