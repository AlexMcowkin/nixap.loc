<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class ErrorController extends Controller
{
    public function actionIndex()
    {
    	$exception = Yii::$app->errorHandler->exception;

        return $this->render('error', ['errorMessage'=>$exception->getMessage()]);
    }
}