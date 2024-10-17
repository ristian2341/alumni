<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Lowker $model */

$this->title = "Informasi Lowongan Kerja";
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lowkers'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
// \yii\web\YiiAsset::register($this);
// print_r($model);die;
?>
<style>
    textarea {
        width: 100%;
        height: 100%;
        -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
        -moz-box-sizing: border-box;    /* Firefox, other Gecko */
        box-sizing: border-box;         /* Opera/IE 8+ */
    }
    div {
        margin-bottom: 1px;
    }
</style>
<div class="lowker-view">
    <div class="row">
        <div class="col-sm-2">
            <label for="font12">Lowongan</label>
        </div>
        <div class="col-sm-10">
            <?= isset($model->lowongan) ? $model->lowongan : ''; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label for="font12">Nama Perusahaan</label>
        </div>
        <div class="col-sm-10">
            <?= isset($model->nama_perusahaan) ? $model->nama_perusahaan : ''; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label for="font12">Alamat Perusahaan</label>
        </div>
        <div class="col-sm-10">
            <?= isset($model->alamat) ? $model->alamat : ''; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label for="font12">Kabupaten</label>
        </div>
        <div class="col-sm-10">
            <?= isset($model->kabupaten) ? $model->kabupaten : ''; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label for="font12">Propinsi</label>
        </div>
        <div class="col-sm-10">
            <?= isset($model->propinsi) ? $model->propinsi : ''; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label for="font12">Hubungi</label>
        </div>
        <div class="col-sm-10">
            Kontak : <?= isset($model->kontak) ? $model->kontak : ''; ?> / <?= isset($model->email) ? $model->email : ''; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label for="font12">Requirement</label>
        </div>
        <div class="col-sm-10 content">
            <textarea disabled><?= isset($model->requirement) ? $model->requirement : ''; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label for="font12">Keterangan</label>
        </div>
        <div class="col-sm-10 content">
            <textarea disabled> <?= isset($model->keterangan) ? $model->keterangan : ''; ?></textarea>
        </div>
    </div>
</div>