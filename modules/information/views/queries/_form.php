<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\Queries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="queries-form">

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true, 'class'=> 'customAjaxForm']]); ?>

    <?= $form->field($model, 'queries_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'queries_date')->widget( DatePicker::class,[
        'data' => $model->queries_date ? date('d.m.Y',($model->queries_date)) : $model->queries_date,
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


    <?= $form->field($model, 'queries_content')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'add_info')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
