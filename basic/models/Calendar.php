<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23.10.2017
 * Time: 21:09
 */

namespace app\models;


use yii\base\Model;

class Calendar extends Model
{
    /** @var  $tasks array Список всех дел */
    public $tasks;
    public $month;          // месяц
    public $year;           // год
    public $day;            // день
    public $daysInMonth;    // дней в заданном месяце
    public $firstDayTime;   // Timestamp первого дня месяца
    public $json;           // то чно будет возвращаться через Ajax


    public function __construct($year, $month, $day = 1)
    {
        // если год и месяц не заданы, то берём текущие
        $year ? $this->year = $year : date('Y');
        $month ? $this->month = $month : date('m');

        $this->day = $day;
        $this->firstDayTime = mktime(0, 0, 0, $month, $day, $year);
        $this->daysInMonth = date('t', $this->firstDayTime);

        $this->getTasks();
        $this->formJson();

        return parent::__construct();
    }

    //Получаем все задачи
    public function getTasks()
    {
        for ($i = 0; $i <= $this->daysInMonth; $i++)
        {
            $time = mktime(0, 0, 0, $this->month, $i, $this->year);
            $this->tasks[$i] = Task::find()->where(['date' => $time])->asArray()->all();
        }
    }

    // Формируем ответ на Ajax запрос в формате JSON
    public function formJson()
    {
        $this->json['month'] = $this->month;
        $this->json['year'] = $this->year;
        $this->json['daysInMonth'] = $this->daysInMonth;
        $this->json['firstDayCount'] = $this->getFirstDay();
        $this->json['days'] = $this->tasks;

        $this->json = json_encode($this->json);
    }

    public function getFirstDay()
    {
        $day = date( "w", $this->firstDayTime);
        if($day == 0)
        {
            $day = 6;
        } else {
            $day -= 1;
        }
        return $day;
    }
}