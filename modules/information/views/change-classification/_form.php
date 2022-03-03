<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\ChangeClassification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="change-classification-form">

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true, 'class'=> 'customAjaxForm']]); ?>

    <?= $form->field($model, 'old_classification_date')->widget( DatePicker::class,[
        'data' => $model->old_classification_date ? date('d.m.Y',($model->old_classification_date)) : $model->old_classification_date,
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

    <?= $form->field($model, 'new_classification_date')->widget( DatePicker::class,[
        'data' => $model->new_classification_date ? date('d.m.Y',($model->new_classification_date)) : $model->new_classification_date,
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
    <?= $form->field($model, 'change_classification_reason')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'add_info')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
