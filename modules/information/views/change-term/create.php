<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\ChangeTerm */

$this->title = Yii::t('app', 'Create Change Term');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Change Terms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="change-term-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
