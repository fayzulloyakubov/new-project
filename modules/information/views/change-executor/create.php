<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\ChangeExecutor */

$this->title = Yii::t('app', 'Create Change Executor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Change Executors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="change-executor-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
