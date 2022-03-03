<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\CheckResult */

$this->title = Yii::t('app', 'Update Check Result: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Check Results'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="check-result-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
