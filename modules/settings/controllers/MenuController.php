<?php

namespace app\modules\settings\controllers;

use Yii;
use app\modules\settings\models\Menu;
use app\modules\settings\models\MenuSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menu();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                $transaction = Yii::$app->db->beginTransaction();
                $saved = false;
                try {
                    if($model->save()){
                        $saved = true;
                    }else{
                        $saved = false;
                    }
                    if($saved) {
                        $transaction->commit();
                    }else{
                        $transaction->rollBack();
                    }
                } catch (\Exception $e) {
                    Yii::info('Not saved' . $e, 'save');
                    $transaction->rollBack();
                }
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $response = [];
                    if ($saved) {
                        $response['status'] = 0;
                        $response['message'] = Yii::t('app', 'Saved Successfully');
                    } else {
                        $response['status'] = 1;
                        $response['errors'] = $model->getErrors();
                        $response['message'] = Yii::t('app', 'Ma\'lumotlar yetarli emas!');
                    }
                    return $response;
                }
                if ($saved) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                $transaction = Yii::$app->db->beginTransaction();
                $saved = false;
                try {
                    if($model->save()){
                        $saved = true;
                    }else{
                        $saved = false;
                    }
                    if($saved) {
                        $transaction->commit();
                    }else{
                        $transaction->rollBack();
                    }
                } catch (\Exception $e) {
                    Yii::info('Not saved' . $e, 'save');
                    $transaction->rollBack();
                }
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $response = [];
                    if ($saved) {
                        $response['status'] = 0;
                        $response['message'] = Yii::t('app', 'Saved Successfully');
                    } else {
                        $response['status'] = 1;
                        $response['errors'] = $model->getErrors();
                        $response['message'] = Yii::t('app', 'Ma\'lumotlar yetarli emas!');
                    }
                    return $response;
                }
                if ($saved) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $isDeleted = false;
        $model = $this->findModel($id);
        try {
            if($model->delete()){
                $isDeleted = true;
            }
            if($isDeleted){
                $transaction->commit();
            }else{
                $transaction->rollBack();
            }
        }catch (\Exception $e){
            Yii::info('Not saved' . $e, 'save');
        }
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $response = [];
            $response['status'] = 1;
            $response['message'] = Yii::t('app', 'Ma\'lumotlar yetarli emas!');
            if($isDeleted){
                $response['status'] = 0;
                $response['message'] = Yii::t('app','Deleted Successfully');
            }
            return $response;
        }
        if($isDeleted){
            Yii::$app->session->setFlash('success',Yii::t('app','Deleted Successfully'));
            return $this->redirect(['index']);
        }else{
            Yii::$app->session->setFlash('error', Yii::t('app', 'Ma\'lumotlar yetarli emas!'));
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    public function actionExportExcel(){
        header('Content-Type: application/vnd.ms-excel');
        $filename = "menu_".date("d-m-Y-His").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        \moonland\phpexcel\Excel::export([
            'models' => Menu::find()->select([
                'id',
            ])->all(),
            'columns' => [
                'id',
            ],
            'headers' => [
                'id' => 'Id',
            ],
            'autoSize' => true,
        ]);
    }
    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
