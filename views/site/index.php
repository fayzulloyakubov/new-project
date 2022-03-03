<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

?>
<?php
$this->title = Yii::t('app','welcome');
?>
    <div class="card" style="background: #7d3aea;">
       <div class="card-body">
               <div class="image text-center"><?= Html::img('/img/logo.png', ['style'=>'width:auto;height:450px;'])?></div>
           <br>
       </div>
    </div>
<?php
$js = <<< JS
    $('#loading').hide();
JS;
$this->registerJs($js,\yii\web\View::POS_READY);