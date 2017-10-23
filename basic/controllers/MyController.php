<?php
namespace app\controllers;


use app\models\Task;
use app\models\TaskFilter;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class MyController extends Controller
{
    public function actionIndex($year = null, $month = null)
    {
        $model = new Task();
        $date = new TaskFilter();
        $currentMonth = null;


        $tasks = $model->daysAndEvents($year, $month);


        return $this->render('index', [
            'tasks' => $tasks,
            'date' => $date,
            'current' => $year . "-" . $month
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
        $date = new Task();
        return $date->daysAndEvents($year, $month);
    }
}