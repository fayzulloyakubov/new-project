<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\CheckResult */

$this->title = Yii::t('app', 'Create Check Result');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Check Results'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-result-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
