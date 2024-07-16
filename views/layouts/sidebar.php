<?php
    use yii\helpers\Url;
    use yii\bootstrap4\Nav;
    use yii\bootstrap4\NavBar;
    use yii\bootstrap4\Html;

    $picture = isset(Yii::$app->user->identity->picture) ? Yii::$app->user->identity->picture : ''

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= url::To(['/site/index']); ?>" class="brand-link">
            <img src="<?= isset($setting->logo) ? Url::base()."/".$setting->logo : ''?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light"><?= isset($setting->nama_aplikasi) ? $setting->nama_aplikasi : 'Yii Basic'?></span>
        </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Brand Logo -->
        <a href="<?= url::To(['/site/index']); ?>" class="brand-link">
            <img src="<?= isset($setting->logo) ? Url::base()."/".$setting->logo : ''?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light"><?= isset($setting->nama_aplikasi) ? $setting->nama_aplikasi : 'Yii Basic'?></span>
        </a>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php
                
                if(Yii::$app->user->identity->developer){
                    echo \hail812\adminlte\widgets\Menu::widget([
                        'items' => [
                            [
                                'label' => 'Setting',
                                'icon' => 'tachometer-alt',
                                'badge' => '<span class="right badge badge-info">2</span>',
                                'items' => [
                                    ['label' => 'Menu', 'url' => ['menu/index'], 'iconStyle' => 'far'],
                                    ['label' => 'Akses User ', 'url' => ['site/about'], 'iconStyle' => 'far'],
                                ]
                            ],
                           
                        ],
                    ]);
                }
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>