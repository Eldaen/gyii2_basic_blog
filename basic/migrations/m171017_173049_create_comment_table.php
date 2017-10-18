<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m171017_173049_create_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'text' => $this->string(255),
            'article_id' => $this->integer(),
            'date' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('comment');
    }
}
