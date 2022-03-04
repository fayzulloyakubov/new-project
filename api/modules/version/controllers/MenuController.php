<?php
namespace app\api\modules\version\controllers;

use app\api\modules\version\models\BaseModel;
use yii\web\Response;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use app\api\modules\version\components\CorsCustom;


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
                'class' => CorsCustom::className()
            ],
            [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionIndex(): array
    {
        $response['items'] = BaseModel::getMenuList();
        $response['status'] = true;
        return $response;
    }





}