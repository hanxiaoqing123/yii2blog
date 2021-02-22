<?php


namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $testObject = Yii::createObject(['class' => 'frontend\components\Test', 'name' => 'new test name'], [20]);
        print_r($testObject);
    }

}