<?php
/**
 * Created by PhpStorm.
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;

class  MyController extends Controller
{
    public function beforeAction($action)
    {
        Yii::$app->language = 'uz';
        if (Yii::$app->controller->action->id !== 'login'){
            if (Yii::$app->user->isGuest){
                //   return $this->redirect(['/site/login']);
            }
        }
        return parent::beforeAction($action);
    }
}

