<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;
use app\controllers\SiteController;

AppAsset::register($this);


\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);

if(empty(Yii::$app->user->identity)){
    return "index.php?r=site/login";
}

// $assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

// modal setting //
use app\models\Setting;
$setting = Setting::find()->where(['id_setting' => 1])->one();
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/'.$setting->icon)]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <title><?= Html::encode($setting->nama_aplikasi) ?></title>
        <script src="<?= Yii::getAlias('@web/'."js/jquery-3.6.0.min.js"); ?>"></script>
        <?php $this->head() ?>
    </head>
    <body class="layout-fixed layout-footer-fixed sidebar-collapse">
    <?php $this->beginBody() ?>
        <div class="wrapper">
            <!-- Navbar -->
            <?= $this->render('navbar', ['setting' => $setting]) ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?= $this->render('sidebar', ['setting' => $setting]) ?>

            <!-- Content Wrapper. Contains page content -->
            <?= $this->render('content', ['content' => $content]) ?> 
            <!-- /.content-wrapper -->
            <footer id="footer" class="main-footer mt-auto bg-light">
                <div class="container-fluid">
                    <div class="col-md-12 text-left">Copyright  &copy; 2024 - <?= strtoupper($setting->instansi) ?>.</div>
                </div>
            </footer>
        </div>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
