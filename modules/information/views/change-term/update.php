<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\ChangeTerm */

$this->title = Yii::t('app', 'Update Change Term: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Change Terms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="change-term-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
