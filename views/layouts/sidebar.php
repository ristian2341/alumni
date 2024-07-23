<?php
    use yii\helpers\Url;
    use yii\bootstrap4\Nav;
    use yii\bootstrap4\NavBar;
    use yii\bootstrap4\Html;
    use app\models\MenuUser;
    use app\models\Menu;

    $picture = isset(Yii::$app->user->identity->picture) ? Yii::$app->user->identity->picture : '';

     /* setting menu user */
     if(Yii::$app->user->id){
        if(!Yii::$app->user->identity->developer){
            $menu = MenuUser::find()->where(['user_id' => Yii::$app->user->id,'id_header' => ''])->orWhere("id_header is null")
                    ->innerJoin('menu','menu_user.id_menu = menu.id_menu')->orderBy('idlevel')->orderBy("urutan")->all();
        }else{
            $menu = Menu::find()->where(['id_header' => ''])->orWhere("id_header is null")->orderBy('idlevel')->orderBy("urutan")->all();
        }
    }
    foreach($menu as $key => $val){
        if(!Yii::$app->user->identity->developer){
            $menu_detil = MenuUser::find()->where(['user_id' => Yii::$app->user->id,'id_header' => $val->id_menu])->orWhere("id_header is null")
                    ->innerJoin('menu','menu_user.id_menu = menu.id_menu')->orderBy('idlevel')->orderBy("urutan")->all();
        }else{
            $menu_detil = Menu::find()->where(['id_header' => $val->id_menu])->orderBy('idlevel')->orderBy("urutan")->all();
        }
        foreach ($menu_detil as $key => $det){
            $item_detail[''] = ['label' => $det->nama, 'url' => $det->url_menu, 'iconStyle' => 'far'];
        }
        $list_header['items']= [
            'label' => $val->nama,
            'icon' => 'tachometer-alt',
            'badge' => '<span class="right badge badge-info">2</span>',
            'items' => [
                $item_detail,
            ]
        ];
    }

    // print_r($list_header);die;
?>
<style>
    .user{
        position: absolute;
        margin-left: -274px;
        margin-top: -8px;
    }
</style>
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
                            $list_header    
                        ],
                    ]);
                }
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>