<?php
namespace app\controllers;


use app\models\Calendar;
use app\models\Task;
use app\models\TaskFilter;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class MyController extends Controller
{
    public function actionIndex($year = null, $month = null)
    {

        $date = new TaskFilter();
        return $this->render('index',
            [
                'date' => $date,
                'current' => date('Y') . "-" . date('m')
            ]);
    }

    public function actionEvents($date)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Task::find()->where(['date'=>$date]),
            'pagination' => [
                'pageSize' => 1,
            ]
        ]);

        return $this->render('event', [
            'dataProvider' => $dataProvider,
            'date' => date('j.m.Y', $date),
        ]);
    }

    public function actionTasks($year = null, $month = null)
    {
        $date = new Calendar($year, $month);
        //var_dump($date->json);
        return $date->json;
    }
}