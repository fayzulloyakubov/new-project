<?php
/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\ReactAsset;
use app\components\Menu\CustomMenu;
use app\components\PermissionHelper as P;
use app\widgets\Alert;
use app\widgets\MultiLang\MultiLang;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\web\JqueryAsset;

AppAsset::register($this);
ReactAsset::$reactFileName = 'menuList';
ReactAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>" type="image/x-icon"/>
    <title>New Project <?= Html::encode($this->title) ?></title>
    <noembed><?= Html::encode($this->title) ?></noembed>
    <?php $this->head() ?>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body class="hold-transition sidebar-mini skin-blue <?= $this->params['bodyClass'] ?? "" ?>">
<!--sidebar-mini-expand-feature fixed-->
<?php $this->beginBody() ?>
<!-- Site wrapper -->
<div class="wrapper">
    <div id="loading" <?= Yii::$app->request->isAjax ? 'style="display:none"' : '' ?>>
        <!-- begin overlay tags -->
        <div class="overlay-body show"></div>
        <div class="spanner-body show">
            <div class="center__block">
                <div class="loader-ajax"></div>
                <p class="spanner-text"><?php echo Yii::t('app', 'Iltimos kuting!..') ?></p>
            </div>
        </div>
        <!-- end overlay tags -->
    </div>


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <?php echo MultiLang::widget(['cssClass' => 'pull-right language']); ?>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                    <span><?php echo Yii::$app->user->identity->username; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#">
                        <?php
                        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                            . Html::submitButton(
                                'Chiqish (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'btn btn-link logout',]
                            )
                            . Html::endForm()
                        ?>
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a class="brand-link text-center" href="/">
            <span class="brand-text font-weight-center">NEW PROJECT</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <div id="root">
                <!--menuList-->
                </div>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content-header card" style="margin-bottom: 0!important;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="m-0 text-dark text-title-all ml-1"><i class="fa fa-spin fa-spinner text-info"></i></h6>
                    </div>
                    <div class="col-sm-6">
                        <?php try {
                            echo \yii\widgets\Breadcrumbs::widget([
                                'options' => [
                                    'class' => 'breadcrumb breadcrumb float-sm-right',
                                ],
                                'tag' => 'ul',
                                'activeItemTemplate' => "<li>&nbsp;/&nbsp;{link}</li>\n",
                                'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>",
                                'links' => $this->params['breadcrumbs'] ?? [],
                            ]);
                        } catch (Exception $e) {
                            Yii::info('Error Breadcrumbs Main ' . $e->getMessage(), 'widgets');
                        } ?>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>

        <?php
        $message = Alert::widget();
        if (!empty($message)): ?>
        <div class="row">
            <div class="col-12" style="padding: 5px 15px 0 15px;">
                <?= $message ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-12" style="padding: 5px 15px 10px 15px;">
                <?= $content ?>
            </div>
        </div>
    </div>
    <footer class="main-footer no-print">
        <strong class="text-orange">&copy; New Project - </strong> <?= date('Y') ?>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>
    window.onload = function () {
        document.getElementById("loading").style.display = "none";
    }
</script>
<?php
$css = <<<CSS
#loading{
    z-index: 999999;
}
.sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .sidebar-menu>li:hover>.treeview-menu{
    top:40px!important;
}
#snow{
    position:fixed;
    top: 0;
    left: 0;
    width: 0;
    display:block;
    text-align:center;
    height: 120vh;
    color: #FFF;
    z-index: 999;
}
.spanner-body{
    position:fixed;
    top: 0;
    left: 0;
    background: rgba(0,0,0,0.6);
    width: 100%;
    display:block;
    text-align:center;
    height: 100vh;
    color: #FFF;
    z-index: 10000;
    visibility: hidden;
}
.center__block{
    position: absolute;
    top: 30%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.overlay-body{
    position: fixed;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    visibility: hidden;
}
.spanner-body .spanner-text{
    font-size: 35px;
}
.loader-ajax,
.loader-ajax:before,
.loader-ajax:after {
    border-radius: 50%;
    width: 2.5em;
    height: 2.5em;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation: load7 1.8s infinite ease-in-out;
    animation: load7 1.8s infinite ease-in-out;
}
.loader-ajax {
    color: #ffffff;
    font-size: 14px;
    margin: 80px auto;
    position: relative;
    text-indent: -9999em;
    -webkit-transform: translateZ(0);
    -ms-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-animation-delay: -0.16s;
    animation-delay: -0.16s;
}
.loader-ajax:before,
.loader-ajax:after {
    content: '';
    position: absolute;
    top: 0;
}
.loader-ajax:before {
    left: -3.5em;
    -webkit-animation-delay: -0.32s;
    animation-delay: -0.32s;
}
.loader-ajax:after {
    left: 3.5em;
}
@-webkit-keyframes load7 {
    0%,
    80%,
    100% {
        box-shadow: 0 2.5em 0 -1.3em;
    }
    40% {
        box-shadow: 0 2.5em 0 0;
    }
}
@keyframes load7 {
    0%,
    80%,
    100% {
        box-shadow: 0 2.5em 0 -1.3em;
    }
    40% {
        box-shadow: 0 2.5em 0 0;
    }
}

.show{
    visibility: visible;
}

.spanner-body, .overlay-body{
    opacity: 0;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    transition: all 0.3s;
}

.spanner-body.show, .overlay.show {
    opacity: 1
}
CSS;
$this->registerCss($css);
$this->registerJsFile('/js/jstree-vakate/jstree.min.js', ['depends' => JqueryAsset::class]);

?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
