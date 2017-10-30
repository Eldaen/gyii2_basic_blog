<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.10.2017
 * Time: 12:15
 */

namespace app\components;


use yii\base\Widget;

class CalendarWidget extends Widget
{
    public $tableClasses;

    public function init()
    {
        parent::init();
        
    }

    public function run()
    {
        return '<script>' .
    "window.onload = function () {" .
        "var table = document.body.querySelector('.tasks-table');" .
        "var searchForm = document.getElementById('search-form');" .
        "var calendar = new Calendar(table, searchForm);" .
    "}" .

                '</script>' .
            '<table class="' . $this->tableClasses . ' tasks-table' . '"></table>';
    }
}