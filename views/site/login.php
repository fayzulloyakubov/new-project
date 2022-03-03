<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = Yii::t('app','New Project');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login container" style="min-height: 70vh; display: flex; justify-content: center; align-items: center; transform: translateY(-30%)">
    <div>
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="login-box-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                ]); ?>

                <?php echo $form->field($model, 'username')->textInput(['autofocus' => true])->label(Yii::t("app","Login")) ?>

                <?php echo $form->field($model, 'password')->passwordInput()->label(Yii::t("app","Password")) ?>

                <div class="form-group">
                    <div class="col-lg-12">
                        <?= Html::submitButton(Yii::t("app","Open"), ['class' => 'btn btn-info','id' => 'open', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
<?php
$this->registerCss("
    .login-box-body{
        box-shadow: 0px 2px 10px;
        padding: 5px 30px;
        border-radius: 4px;
        background: #ffffff;
        padding-top: 30px;
        padding-bottom: 10px;
    }
    body{
        background: #7d3aea!important;
    }
    #open{
        width:100%;
        background: #7d3aea;
    }
");
?>
