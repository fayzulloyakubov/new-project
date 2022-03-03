<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\ChangeClassification */

$this->title = Yii::t('app', 'Create Change Classification');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Change Classifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="change-classification-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
