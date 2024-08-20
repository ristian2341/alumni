<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SiswaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="siswa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'nipd') ?>

    <?= $form->field($model, 'nisn') ?>

    <?= $form->field($model, 'nik') ?>

    <?= $form->field($model, 'nama') ?>

    <?php // echo $form->field($model, 'jen_kelamin') ?>

    <?php // echo $form->field($model, 'tempat_lahir') ?>

    <?php // echo $form->field($model, 'tgl_lahir') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'rt') ?>

    <?php // echo $form->field($model, 'rw') ?>

    <?php // echo $form->field($model, 'dusun') ?>

    <?php // echo $form->field($model, 'kelurahan') ?>

    <?php // echo $form->field($model, 'kecamatan') ?>

    <?php // echo $form->field($model, 'kabupaten') ?>

    <?php // echo $form->field($model, 'kode_pos') ?>

    <?php // echo $form->field($model, 'jenis_tinggal') ?>

    <?php // echo $form->field($model, 'alat_transportasi') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'handphone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'skhun') ?>

    <?php // echo $form->field($model, 'no_kps') ?>

    <?php // echo $form->field($model, 'nama_ayah') ?>

    <?php // echo $form->field($model, 'tgl_lahir_ayah') ?>

    <?php // echo $form->field($model, 'pendidikan_ayah') ?>

    <?php // echo $form->field($model, 'pekerjaan_ayah') ?>

    <?php // echo $form->field($model, 'penghasilan_ayah') ?>

    <?php // echo $form->field($model, 'nik_ayah') ?>

    <?php // echo $form->field($model, 'nama_ibu') ?>

    <?php // echo $form->field($model, 'tgl_lahir_ibu') ?>

    <?php // echo $form->field($model, 'pendidikan_ibu') ?>

    <?php // echo $form->field($model, 'pekerjaan_ibu') ?>

    <?php // echo $form->field($model, 'penghasilan_ibu') ?>

    <?php // echo $form->field($model, 'nik_ibu') ?>

    <?php // echo $form->field($model, 'nama_wali') ?>

    <?php // echo $form->field($model, 'tgl_lahir_wali') ?>

    <?php // echo $form->field($model, 'pendidikan_wali') ?>

    <?php // echo $form->field($model, 'pekerjaan_wali') ?>

    <?php // echo $form->field($model, 'penghasilan_wali') ?>

    <?php // echo $form->field($model, 'nik_wali') ?>

    <?php // echo $form->field($model, 'rombel_now') ?>

    <?php // echo $form->field($model, 'no_peserta_ujian') ?>

    <?php // echo $form->field($model, 'no_seri_ijazah') ?>

    <?php // echo $form->field($model, 'nomor_kip') ?>

    <?php // echo $form->field($model, 'nama_di_kip') ?>

    <?php // echo $form->field($model, 'nomor_kks') ?>

    <?php // echo $form->field($model, 'no_akta_lahir') ?>

    <?php // echo $form->field($model, 'bank') ?>

    <?php // echo $form->field($model, 'no_rekening_bank') ?>

    <?php // echo $form->field($model, 'atas_nama_rekening') ?>

    <?php // echo $form->field($model, 'layak_pip') ?>

    <?php // echo $form->field($model, 'alasan_layak_pip') ?>

    <?php // echo $form->field($model, 'kebutuhan_khusus') ?>

    <?php // echo $form->field($model, 'sekolah_asal') ?>

    <?php // echo $form->field($model, 'anak_keberapa') ?>

    <?php // echo $form->field($model, 'lintang') ?>

    <?php // echo $form->field($model, 'bujur') ?>

    <?php // echo $form->field($model, 'no_kk') ?>

    <?php // echo $form->field($model, 'berat_badan') ?>

    <?php // echo $form->field($model, 'tinggi_badan') ?>

    <?php // echo $form->field($model, 'lingkar_kepala') ?>

    <?php // echo $form->field($model, 'jml_saudara') ?>

    <?php // echo $form->field($model, 'jarak_rumah') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
