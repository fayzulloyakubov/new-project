<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Auth Items');
$this->params['breadcrumbs'][] = $this->title;

?>
    <div class="auth-item-index card">
        <!--    --><?php //if (Yii::$app->user->can('auth-item/create')): ?>
        <p class="pull-right no-print">
            <?= Html::a('<span class="fa fa-plus"></span>', ['create'],
                ['class' => 'create-dialog btn btn-sm btn-success', 'id' => 'buttonAjax']) ?>
        </p>
        <!--    --><?php //endif; ?>

        <?php Pjax::begin(['id' => 'auth-item_pjax']); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterRowOptions' => ['class' => 'filters no-print'],
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'name_for_user',
                    'label' => Yii::t('app', "Foydalanuvchi uchun roll nomi"),
                    'value' => function ($m) {
                            return $m['name_for_user'] ?? false;
                    }
                ],
                [
                    'attribute' => 'name',
                    'label' => Yii::t('app', "Roll nomi"),
                    'value' => function ($m) {
                        return $m['name'] ?? false;
                    }
                ],
                'description:ntext',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {change-child}',
                    'contentOptions' => ['class' => 'no-print', 'style' => 'width:150px;'],
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('<span class="fa fa-pencil-alt"></span>', $url, [
                                'title' => Yii::t('app', 'Update'),
                                'class' => 'update-dialog btn btn-xs btn-success',
                                'data-form-id' => $model->name,
                            ]);
                        },
                        'change-child' => function ($url, $model) {
                            return Html::a('<span class="fa fa-bell"></span>', $url, [
                                'title' => Yii::t('app', 'Update'),
                                'class' => 'btn btn-xs btn-info',
                                'data-form-id' => $model->name,
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>
<?= \app\widgets\ModalWindow\ModalWindow::widget([
    'model' => 'auth-item',
    'crud_name' => 'auth-item',
    'modal_id' => 'auth-item-modal',
    'modal_header' => '<h5>' . Yii::t('app', 'Auth Items') . '</h5>',
    'active_from_class' => 'customAjaxForm',
    'update_button' => 'update-dialog',
    'create_button' => 'create-dialog',
    'view_button' => 'view-dialog',
    'delete_button' => 'delete-dialog',
    'modal_size' => 'modal-lg',
    'options' => [
        'data-backdrop' => 'static',
        'data-keyboard' => 'true',
    ],
    'grid_ajax' => 'auth-item_pjax',
    'confirm_message' => Yii::t('app', 'Haqiqatan ham ushbu mahsulotni yo\'q qilmoqchimisiz?')
]); ?>
<?php
$js = <<< JS
    $('body').delegate('#check-permissions','click',function() {
        if($(this). prop("checked") == true){
            $('#permissions-content').show();
        }else{
            $('#permissions-content').hide();
        }
    });
    $('body').delegate('.checkbox-check','click',function() {
        let parent = $(this).parents('fieldset');
        let input = parent.find('input[type="checkbox"]');
        let label = parent.find('.label_checkbox');
        if($(this).prop("checked") == true){
            input.prop("checked",true);
            label.html($(this).attr('data-unchecked'));
        }else{
            input.prop("checked",false);
            label.html($(this).attr('data-checked'));
        }
    });
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
