<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\ChangeExecutor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="change-executor-form">

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true, 'class'=> 'customAjaxForm']]); ?>

    <?= $form->field($model, 'old_executor_date')->widget( DatePicker::class,[
        'data' => $model->old_executor_date ? date('d.m.Y',($model->old_executor_date)) : $model->old_executor_date,
        'removeButton' => false,
        'options' => [
            'autocomplete' => 'off',
        ],
        'pluginOptions' => [
            'todayHighlight' => true,
            'autoclose' => true,
            'format' => 'dd.mm.yyyy'
        ]
    ])?>


    <?= $form->field($model, 'new_executor_date')->widget( DatePicker::class,[
        'data' => $model->new_executor_time ? date('d.m.Y',($model->new_executor_time)) : $model->new_executor_time,
        'removeButton' => false,
        'options' => [
            'autocomplete' => 'off',
        ],
        'pluginOptions' => [
            'todayHighlight' => true,
            'autoclose' => true,
            'format' => 'dd.mm.yyyy'
        ]
    ])?>

    <?= $form->field($model, 'change_executor_reason')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'add_info')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
