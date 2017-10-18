<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.10.2017
 * Time: 14:33
 */

namespace app\controllers;


use yii\web\Controller;

class UserProfileController extends Controller
{
    public function actionIndex()
    {
        echo 'hello';
    }
    public function actionProfile($id)
    {

        echo 'Здесь будет профиль пользователя с ID = ' . $id;
    }
}