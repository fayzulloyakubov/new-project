<?php
namespace api\controllers;

use app\api\model\Menu;
use app\api\modules\components\CorsCustom;
use Yii;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\web\Response;

class MenuController extends ActiveController
{
    public $modelClass = 'app\modules\settings\models\Menu';

    public $enableCsrfValidation = false;

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['index']);
        unset($actions['view']);
        return $actions;
    }

    /**
     * @return array[]
     */
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => CorsCustom::class
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'api-actions' => ['GET'],
                ],
            ],
            [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionLeft()
    {
        $request = Yii::$app->request;
        $get = $request->get();
        $type = $get["type"];
        $user = Yii::$app->user->identity->id;
        $response = [ "status" => true];
        switch ($type){
            case "MENU_LIST":
                $response = Menu::getMenuList($user);
                break;
        }

        return $response;
    }





}