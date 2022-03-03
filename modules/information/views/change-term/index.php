<?php

use app\models\Users;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\information\models\ChangeTermSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Change Terms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card change-term-index">
    <?php if (Yii::$app->user->can('change-term/create')): ?>
    <div class="card-header pull-right no-print">
        <?= Html::a('<span class="fa fa-plus"></span>', ['create'],
        ['class' => 'create-dialog btn btn-sm btn-success', 'id' => 'buttonAjax']) ?>
    </div>
    <?php endif; ?>
    <div class="card-body">
        <?php Pjax::begin(['id' => 'change-term_pjax']); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterRowOptions' => ['class' => 'filters no-print'],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'old_term_date',
            'new_term_date',
            'change_term_reason:ntext',
            'add_info:ntext',
            [
                'attribute' => 'status',
                'value' => function($model){
                    $info = $model::getStatusList($model->status);
                    return $info;
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'created_by',
                'value' => function($model){
                    if ($model->created_by) {
                        $username = Users::findOne($model->created_by)['username'];
                        return $username ?? $model->created_by;
                    }
                    return false;
                }
            ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}{view}{delete}',
                    'contentOptions' => ['class' => 'no-print text-center','style' => 'width:100px;'],
                    'visibleButtons' => [
                        'view' => Yii::$app->user->can('change-term/view'),
                        'update' => function($model) {
                            return Yii::$app->user->can('change-term/update') && $model->status < $model::STATUS_SAVED;
                        },
                        'delete' => function($model) {
                            return Yii::$app->user->can('change-term/delete') && $model->status < $model::STATUS_SAVED;
                        }
                    ],
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('<span class="fa fa-pencil-alt"></span>', $url, [
                                'title' => Yii::t('app', 'Update'),
                                'class'=> 'update-dialog btn btn-xs btn-success mr1',
                                'data-form-id' => $model->id,
                            ]);
                        },
                        'view' => function ($url, $model) {
                            return Html::a('<span class="fa fa-eye"></span>', $url, [
                                'title' => Yii::t('app', 'View'),
                                'class'=> 'btn btn-xs btn-primary view-dialog mr1',
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
        ]) ?>

        <?php Pjax::end(); ?>
    </div>
</div>
<?=  \app\widgets\ModalWindow\ModalWindow::widget([
    'model' => 'change-term',
    'crud_name' => 'change-term',
    'modal_id' => 'change-term-modal',
    'modal_header' => '<h5>'. Yii::t('app', 'Change Term') . '</h5>',
    'active_from_class' => 'customAjaxForm',
    'update_button' => 'update-dialog',
    'create_button' => 'create-dialog',
    'view_button' => 'view-dialog',
    'delete_button' => 'delete-dialog',
    'modal_size' => 'modal-md',
    'grid_ajax' => 'change-term_pjax',
    'confirm_message' => Yii::t('app', 'Rostdan ham o\'chirmoqchimisiz?')
]); ?>
