<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\Issues */

$this->title = Yii::t('app', 'Create Issues');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Issues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="issues-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
