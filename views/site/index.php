<?php

/** @var yii\web\View $this */
use app\models\Setting;
$setting = Setting::find()->where(['id_setting' => 1])->one();

$this->title = isset($setting->nama_aplikasi) ? $setting->nama_aplikasi : 'My Yii Aplication';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Selamat Datang!</h1>
        <p class="lead"><?= isset($setting->instansi) ? $setting->instansi : ''; ?></p>
    </div>
</div>
