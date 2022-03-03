<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\CheckResult */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="check-result-form">

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true, 'class'=> 'customAjaxForm']]); ?>

    <?= $form->field($model, 'check_result_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_result_date')->widget( DatePicker::class,[
        'data' => $model->check_result_date ? date('d.m.Y',($model->check_result_date)) : $model->check_result_date,
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


    <?= $form->field($model, 'add_info')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
