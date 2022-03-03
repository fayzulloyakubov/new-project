<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\References */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="references-form">

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true, 'class'=> 'customAjaxForm']]); ?>

    <?= $form->field($model, 'reference_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reference_date')->widget( DatePicker::class,[
        'data' => $model->reference_date ? date('d.m.Y',($model->reference_date)) : $model->reference_date,
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

    <?= $form->field($model, 'reference_content')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'add_info')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
