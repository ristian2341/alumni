<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Siswa $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="siswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nipd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nisn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jen_kelamin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_lahir')->textInput() ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rw')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dusun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kelurahan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kecamatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kabupaten')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kode_pos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_tinggal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alat_transportasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'handphone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skhun')->textInput() ?>

    <?= $form->field($model, 'no_kps')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_ayah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_lahir_ayah')->textInput() ?>

    <?= $form->field($model, 'pendidikan_ayah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pekerjaan_ayah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'penghasilan_ayah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nik_ayah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_ibu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_lahir_ibu')->textInput() ?>

    <?= $form->field($model, 'pendidikan_ibu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pekerjaan_ibu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'penghasilan_ibu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nik_ibu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_wali')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_lahir_wali')->textInput() ?>

    <?= $form->field($model, 'pendidikan_wali')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pekerjaan_wali')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'penghasilan_wali')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nik_wali')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rombel_now')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_peserta_ujian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_seri_ijazah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomor_kip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_di_kip')->textInput() ?>

    <?= $form->field($model, 'nomor_kks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_akta_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_rekening_bank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'atas_nama_rekening')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'layak_pip')->textInput() ?>

    <?= $form->field($model, 'alasan_layak_pip')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kebutuhan_khusus')->textInput() ?>

    <?= $form->field($model, 'sekolah_asal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anak_keberapa')->textInput() ?>

    <?= $form->field($model, 'lintang')->textInput() ?>

    <?= $form->field($model, 'bujur')->textInput() ?>

    <?= $form->field($model, 'no_kk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'berat_badan')->textInput() ?>

    <?= $form->field($model, 'tinggi_badan')->textInput() ?>

    <?= $form->field($model, 'lingkar_kepala')->textInput() ?>

    <?= $form->field($model, 'jml_saudara')->textInput() ?>

    <?= $form->field($model, 'jarak_rumah')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
