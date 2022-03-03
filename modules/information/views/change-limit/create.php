<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\ChangeLimit */

$this->title = Yii::t('app', 'Create Change Limit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Change Limits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="change-limit-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
