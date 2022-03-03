<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\ChangeTerm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="change-term-form">

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true, 'class'=> 'customAjaxForm']]); ?>

    <?= $form->field($model, 'old_term_date')->widget( DatePicker::class,[
        'data' => $model->old_term_date ? date('d.m.Y',($model->old_term_date)) : $model->old_term_date,
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

    <?= $form->field($model, 'new_term_date')->widget( DatePicker::class,[
        'data' => $model->new_term_date ? date('d.m.Y',($model->new_term_date)) : $model->new_term_date,
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

    <?= $form->field($model, 'change_term_reason')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'add_info')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
