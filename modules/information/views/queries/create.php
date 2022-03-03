<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\information\models\Queries */

$this->title = Yii::t('app', 'Create Queries');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Queries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queries-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
