<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    $picture = isset(Yii::$app->user->identity->picture) ? Yii::$app->user->identity->picture : '';
   
?>
<style>
    
    .nav-item a {}
    .nav-item .nav-link img {
        float: left;
        height: 20px;
        left: 50%;
        top: 20%;
        width: 25px;
        margin-top: 0px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        -moz-transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    .navbar-nav > .user-menu > .dropdown-menu > li.user-header {
        height: 170px;
        padding: 10px;
        text-align: center;
    }

    .pull-right {
        @extend .float-right;
        float : inline-end;
    }
    .pull-left {
        @extend .float-left;
        float : inline-start;
    }
    
</style>
<!-- Navbar -->
<nav class="navbar navbar-dark" style="width: 100%;z-index:9999;top: 0;position: fixed;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ms-auto mb-lg-0">
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav">
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= $picture; ?>" class="user-image" alt="User Image">
                <span class="hidden-xs" id="nama_preload-index-1"><?=Yii::$app->user->identity->full_name?></span>
            </a>
            <ul class="dropdown-menu">
                <li class="user-header" style="background-color: #4c4444;">
                    <img src="<?= $picture; ?>" class="img-circle" alt="User Image">
                    <p id="nama_preload-index-2" style="margin-bottom:0px;color: white;"><?=Yii::$app->user->identity->full_name?></p>
                    <p style="font-size:12px;color:white;margin-bottom:0px;margin-top:0px;"<?=Yii::$app->user->identity->full_name?></p>
                    <p style="color:yellow;font-size:10px;margin:0px 10px 0px 10px;"><?=Yii::$app->user->identity->full_name?></p>
                </li>
                <li class="user-footer">
                    <div class="pull-left">
                        <?= Html::a('<i class="fa fa-user"></i> Profile',['site/profile'], ['data-method' => 'post', 'class' => 'btn btn-success btn-flat']) ?>
                    </div>
                    <div class="pull-right">
                        <?= Html::a('<i class="fas fa-sign-out-alt"></i> Log Out', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-warning btn-flat']) ?>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->