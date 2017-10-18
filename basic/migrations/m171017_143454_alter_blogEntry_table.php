<?php

use yii\db\Migration;

class m171017_143454_alter_blogEntry_table extends Migration
{
    public function up()
    {
        $this->addColumn('blogentry', 'preview', $this->string(200)->after('title'));
    }

    public function down()
    {
        $this->dropColumn('blogentry','preview');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171017_143454_alter_blogEntry_table cannot be reverted.\n";

        return false;
    }
    */
}
