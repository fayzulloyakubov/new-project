<?php
/**
 * Created By PhpStorm
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $searchModel \app\modules\admin\models\AuthItemSearch */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Permissions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index card">
<!--    --><?php //if (Yii::$app->user->can('auth-item/create')): ?>
        <p class="pull-right no-print">
            <?= Html::a('<span class="fa fa-plus"></span>', ['create','permission'=>true],
                [
                    'class' => 'default_button btn btn-sm btn-success',
                    'default-url' => Url::to(['auth-item/create', 'permission'=>true])
                ]) ?>
        </p>
<!--    --><?php //endif; ?>

    <?php Pjax::begin(['id' => 'auth-item_pjax']); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'category',
            'description:ntext',
            [
                'attribute' =>   'updated_at',
                'label' => Yii::t("app","Updated At"),
                'value' => function($searchModel){
                    return date('d.m.Y H:i:s', $searchModel->updated_at);
                },

            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {view} {delete}',
                'contentOptions' => ['class' => 'no-print','style' => 'width:150px;'],
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="fa fa-pencil-alt"></span>', $url, [
                            'title' => Yii::t('app', 'Update'),
                            'class'=> 'update-dialog btn btn-xs btn-success',
                            'data-form-id' => $model->name,
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye"></span>', $url, [
                            'title' => Yii::t('app', 'View'),
                            'class'=> 'btn btn-xs btn-primary view-dialog',
                            'data-form-id' => $model->name,
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="fa fa-trash"></span>', '#', [
                            'title' => Yii::t('app', 'Delete'),
                            'class' => 'btn btn-xs btn-danger delete-dialog',
                            'data-form-id' => $model->name,
                        ]);
                    },

                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
<?=  \app\widgets\ModalWindow\ModalWindow::widget([
    'model' => 'auth-item',
    'crud_name' => 'auth-item',
    'modal_id' => 'auth-item-modal',
    'modal_header' => '<h5>'. Yii::t('app', 'Auth Items') . '</h5>',
    'active_from_class' => 'customAjaxForm',
    'update_button' => 'update-dialog',
    'create_button' => 'create-dialog',
    'view_button' => 'view-dialog',
    'delete_button' => 'delete-dialog',
    'modal_size' => 'modal-md',
    'options' => [
        'data-backdrop' => 'static',
        'data-keyboard' => 'true',
    ],
    'grid_ajax' => 'auth-item_pjax',
    'confirm_message' => Yii::t('app', 'Haqiqatan ham ushbu mahsulotni yo\'q qilmoqchimisiz?')
]); ?>
