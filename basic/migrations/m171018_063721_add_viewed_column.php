<?php

use yii\db\Migration;

class m171018_063721_add_viewed_column extends Migration
{
    public function safeUp()
    {
        $this->addColumn('blogentry', 'viewed', $this->integer()->after('id'));
        $this->addColumn('blogentry', 'date', $this->dateTime()->after('user_id'));
    }

    public function safeDown()
    {
        $this->dropColumn('blogentry','viewed');
        $this->dropColumn('blogentry','date');
    }
}
