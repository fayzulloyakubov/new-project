<?php

use app\models\BaseModel;
use app\models\Users;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
use app\components\Permission\PermissionHelper as P;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card users-index">
<!--    --><?php //if (Yii::$app->user->can('users/create')): ?>
        <div class="card-header pull-right no-print">
            <?= Html::a('<span class="fa fa-plus"></span>', ['create'],
                ['class' => 'create-dialog btn btn-sm btn-success', 'id' => 'buttonAjax']) ?>
        </div>
<!--    --><?php //endif; ?>
    <div class="card-body">
        <?php Pjax::begin(['id' => 'users_pjax']); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterRowOptions' => ['class' => 'filters no-print'],
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'username',
                [
                    'attribute' => 'status',
                    'label' => Yii::t("app","Status"),
                    'value' => function($model){
                        $status = $model::getStatusList($model->status);
                        return isset($status)?$status:$model->status;
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'contentOptions' => ['class' => 'no-print', 'style' => 'width:100px;'],
                    'visibleButtons' => [
                        'update' => function (Users $model) {
                            return Yii::$app->user->can('users/update') || $model->status == $model::STATUS_ACTIVE;
                        },
                        'delete' => function (Users $model) {
                            return Yii::$app->user->can('users/delete') || $model->status == $model::STATUS_ACTIVE;
                        }
                    ],
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('<span class="fa fa-pencil-alt"></span>', $url, [
                                'title' => Yii::t('app', 'Update'),
                                'class' => 'update-dialog btn btn-xs btn-success mr1',
                                'data-form-id' => $model->id,
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="fa fa-trash-alt"></span>', $url, [
                                'title' => Yii::t('app', 'Delete'),
                                'class' => 'btn btn-xs btn-danger delete-dialog',
                                'data-form-id' => $model->id,
                            ]);
                        },

                    ],
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>
<?php echo \app\widgets\ModalWindow\ModalWindow::widget([
    'model' => 'users',
    'crud_name' => 'users',
    'modal_id' => 'users-modal',
    'modal_header' => '<h5>' . Yii::t('app', 'Users') . '</h5>',
    'active_from_class' => 'customAjaxForm',
    'update_button' => 'update-dialog',
    'create_button' => 'create-dialog',
    'view_button' => 'view-dialog',
    'delete_button' => 'delete-dialog',
    'modal_size' => 'modal-xl',
    'grid_ajax' => 'users_pjax',
    'confirm_message' => Yii::t('app', 'Rostdan ham o\'chirmoqchimisiz?')
]); ?>
<!--
--><?php
/*$this->registerJsVar("getEmployeeDataUrl", Url::to(["/hr/hr-employee/get-employee-data"]));
$js = <<<JS
    function hrOrganisationChange() {
        $("body").delegate("#hr_employee_id", 'change', function(e) {
            let id = $(this).val(); // hr_organisation_id
            $("#hr_organisation_name").val("");
            $("#hr_deparment_name").val("");
            $("#phone_number").val("");
            $("#email").val("");
            
            if (id){
                $.ajax({
                    url: getEmployeeDataUrl + "?id=" + id,
                    success: function(data){ 
                        if (data.status){
                            $("#hr_organisation_name").val(data.employee.organisations_name);
                            $("#hr_deparment_name").val(data.employee.department_name);
                            $("#phone_number").val(data.employee.phone_number);
                            $("#email").val(data.employee.email);
                        }
                    },
                });
            }
        });
    }
    hrOrganisationChange();

JS;
$this->registerJs($js, View::POS_READY);*/
?>