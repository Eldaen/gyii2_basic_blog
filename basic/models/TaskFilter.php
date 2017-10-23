<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23.10.2017
 * Time: 12:04
 */

namespace app\models;


use yii\base\Model;

class TaskFilter extends Model
{
    public $sort_date;

    public function rules()
    {
       return
           [
               [['sort_date'], 'date', 'format' => 'Y-m-d']
           ];
    }
}