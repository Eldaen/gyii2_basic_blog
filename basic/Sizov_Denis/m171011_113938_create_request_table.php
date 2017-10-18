<?php

use yii\db\Migration;

/**
 * Handles the creation of table `request`.
 */
class m171011_113938_create_request_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('request', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'address' => $this->string(255),
            'email' => $this->string(255),
            'phone' => $this->string(10),
            'date_create' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('request');
    }
}
