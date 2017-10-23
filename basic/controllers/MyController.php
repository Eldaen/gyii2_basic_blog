<?php
namespace app\controllers;


use app\models\Task;
use app\models\TaskFilter;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class MyController extends Controller
{
    public function actionIndex()
    {
        $model = new Task();
        $tasks = $model->daysAndEvents();

        return $this->render('index', ['tasks' => $tasks]);
    }
    public function actionIndex2()
    {
        $model = new Task();
        $date = new TaskFilter();
        $currentMonth = null;

        if($date->load(Yii::$app->request->post()))
        {
            $tasks = $model->daysAndEvents($date->sort_date);
            $array = explode('-', $date->sort_date);
            $currentMonth = $array[0] . '-' . $array[1];
        } else {
            $tasks = $model->daysAndEvents();
        }

        return $this->render('index2', [
            'tasks' => $tasks,
            'date' => $date,
            'currentMonth' => $currentMonth
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
}