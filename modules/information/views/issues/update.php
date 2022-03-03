<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\Issues */

$this->title = Yii::t('app', 'Update Issues: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Issues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="issues-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
