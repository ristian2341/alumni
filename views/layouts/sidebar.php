<?php
    use yii\helpers\Url;
    use yii\bootstrap4\Nav;
    use yii\bootstrap4\NavBar;
    use yii\bootstrap4\Html;
    use app\models\Menu;

    $picture = isset(Yii::$app->user->identity->picture) ? Yii::$app->user->identity->picture : '';

    /* setting menu user */
    if(Yii::$app->user->id){
        if(!Yii::$app->user->identity->developer){
            $menu = Menu::find()->innerJoin('group_menu_detail',"menu.id_menu = group_menu_detail.id_menu")
            ->where(['group_menu_detail.id_group' => Yii::$app->user->identity->id_group])
            ->andWhere("menu.id_header = '' or menu.id_header is null")->orderBy('idlevel')->orderBy("urutan")->all();
        }else{
            $menu = Menu::find()->where(['id_header' => ''])->orWhere("id_header is null")->orderBy('idlevel')->orderBy("urutan")->all();
        }
    }

    foreach($menu as $key => $val){
        if(!Yii::$app->user->identity->developer){
            $menu_detil =   Menu::find()->innerJoin('group_menu_detail',"menu.id_menu = group_menu_detail.id_menu")
            ->where(['group_menu_detail.id_group' => Yii::$app->user->identity->id_group,'id_header' => $val->id_menu])
            ->orderBy('idlevel')->orderBy("urutan")->all();
        }else{
            $menu_detil = Menu::find()->where(['id_header' => $val->id_menu])->orderBy('idlevel')->orderBy("urutan")->all();
        }
        
        foreach ($menu_detil as $key => $det){
            $item_detail[$det->id_header][] = ['label' => $det->nama, 'url' => $det->url_menu, 'iconStyle' => 'far'];
        }
        $list_header[]= [
            'id_menu' => $val->id_menu,
            'label' => $val->nama,
            'icon' => 'tachometer-alt',
            'badge' => '<span class="right badge badge-info">2</span>',
            'url' => $val->url_menu
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

    .nav-sidebar .nav-treeview {
        display: none;
        list-style: none;
        padding-left: 15px;
    }

    li .active {
        padding-left: 0px;
    }

     .layout-navbar-fixed .wrapper .brand-link {
        width : 242px;
        top : 57px;
    }
    
    .layout-fixed .main-sidebar {
        top : 57px;
    }

    .layout-navbar-fixed .wrapper .content-wrapper {
        margin-top: 1px;
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
        <!-- Sidebar Menu -->
        <nav class="mt-2">
             <!-- Brand Logo -->
            <a href="<?= url::To(['/site/index']); ?>" class="brand-link">
                <img src="<?= isset($setting->logo) ? Url::base()."/".$setting->logo : ''?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light"><?= isset($setting->nama_aplikasi) ? $setting->nama_aplikasi : 'Yii Basic'?></span>
            </a>

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
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php
                if(isset($list_header)): 
                foreach ($list_header as $key => $header){ 
            ?>
                <?php if(empty($header['url'])){ ?>
                    <li class="nav-item active menu-close"><a class="nav-link" href="#"><i class="fas fa-arrow-circle-down"></i> <p><?= $header['label'];?><i class="right fas fa-angle-left"></i> <span class="right badge badge-info"></span></p></a>
                        <?php foreach ($item_detail[$header['id_menu']] as $detail){ ?>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><?= Html::a('<i class="fas fa-arrow-circle-right"></i> <p>'.$detail['label']."</p>",[$detail['url']], ['data-method' => 'post', 'class' => 'nav-link on_click']) ?></li>
                            </ul>
                        <?php } ?>
                    </li>
                <?php }elseif($header['url'] == "#"){ ?>
                    <li class="nav-item active menu-close"><a class="nav-link" href="#"><i class="fas fa-arrow-circle-down"></i> <p><?= $header['label'];?><i class="right fas fa-angle-left"></i> <span class="right badge badge-info"></span></p></a>
                        <?php
                            if(!empty($item_detail[$header['id_menu']])){ 
                            foreach ($item_detail[$header['id_menu']] as $detail){ 
                        ?>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><?= Html::a('<i class="fas fa-arrow-circle-right"></i> <p>'.$detail['label'].'</p>',[$detail['url']], ['data-method' => 'post', 'class' => 'nav-link on_click']) ?></li>
                            </ul>
                        <?php }} ?>
                    </li>
                <?php }elseif(!empty($header['url']) && $header['url'] != "#"){ ?>
                        <li class="nav-item"><?= Html::a('<i class="fas fa-arrow-circle-right"></i> <p>'.$header['label'].'</p>',[$header['url']], ['data-method' => 'post', 'class' => 'nav-link on_click']) ?></li>
            <?php    
                    }
                }
            endif; ?>
                <?php if(Yii::$app->user->identity->developer): ?>
                    <li class="nav-item"><?= Html::a('<i class="fas fa-arrow-circle-right"></i> <p>Menu</p>',['menu/index'], ['data-method' => 'post', 'class' => 'nav-link on_click']) ?></li>
                <?php endif; ?>
                    <li class="nav-item"><?= Html::a('<i class="fas fa-sign-out-alt"></i> <p>Log Out</p>',['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link on_click']) ?></li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script>
    $("body").off("click",".on_click").on("click",".on_click",function(){
        
    });
</script>