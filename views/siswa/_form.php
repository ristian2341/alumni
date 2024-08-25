<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Siswa $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
  nav > .nav.nav-tabs{
    border: none;
    color:#fff;
    background:#272e38;
    border-radius:0;

  }
  nav > div a.nav-item.nav-link,
  nav > div a.nav-item.nav-link.active
  {
  border: none;
    padding: 18px 25px;
    color:#fff;
    background:#272e38;
    border-radius:0;
  }

  nav > div a.nav-item.nav-link.active:after
  {
  content: "";
  position: relative;
  bottom: -60px;
  left: -10%;
  border: 15px solid transparent;
  border-top-color: #e74c3c ;
  }
  .tab-content{
    background: #fdfdfd;
    line-height: 25px;
    border: 1px solid #ddd;
    border-top:5px solid #e74c3c;
    border-bottom:5px solid #e74c3c;
    padding:30px 25px;
  }

  nav > div a.nav-item.nav-link:hover,
  nav > div a.nav-item.nav-link:focus
  {
  border: none;
    background: #e74c3c;
    color:#fff;
    border-radius:0;
    transition:background 0.20s linear;
  }

  .canvas {
    border-style: solid;
    border-width: 1px;
    border-color: black;
  }

  input {
    font-family: verdana;
    font-size: 12pt;
  }
</style>        
<div class="siswa-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-data_siswa" data-toggle="tab" href="#nav-data-siswa" role="tab" aria-controls="nav-data-siswa" aria-selected="true">Biodata Siswa</a>
                <a class="nav-item nav-link" id="nav-sekolah-tab" data-toggle="tab" href="#nav-sekolah" role="tab" aria-controls="nav-sekolah" aria-selected="false">Data Sekolah</a>
                <a class="nav-item nav-link" id="nav-bank-tab" data-toggle="tab" href="#nav-bank" role="tab" aria-controls="nav-bank" aria-selected="false">Data Bank</a>
                <a class="nav-item nav-link" id="nav-picture-tab" data-toggle="tab" href="#nav-picture" role="tab" aria-controls="nav-picture" aria-selected="false">Data Orang Tua / Wali</a>
            </div>
        </nav>  
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-data-siswa" role="tabpanel" aria-labelledby="nav-data_siswa">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <?= $form->field($model, 'nik')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-12">
                                <?= $form->field($model, 'nama')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'jen_kelamin')->dropDownList(['L' => 'Laki-Laki','P' => 'Perempuan'],['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'tgl_lahir')->textInput(['autocomplete' => "off",'value'=> date('d/m/Y',strtotime($model->tgl_lahir))]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'phone')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'handphone')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'email')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'no_akta_lahir')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'no_kk')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-8">
                                <?= $form->field($model, 'alamat')->textArea(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-1">
                                <?= $form->field($model, 'rt')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-1">
                                <?= $form->field($model, 'rw')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($model, 'kode_pos')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'dusun')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'kelurahan')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-8">
                                <?= $form->field($model, 'kecamatan')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                            <!-- <div class="col-sm-6">
                                <?= $form->field($model, 'kabupaten')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div> -->
                            <div class="col-sm-4">
                                <?= $form->field($model, 'jenis_tinggal')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-4">
                            <?= $form->field($model, 'alat_transportasi')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($model, 'anak_keberapa')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'lintang')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'bujur')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'berat_badan')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'tinggi_badan')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'lingkar_kepala')->textInput(['autocomplete' => "off"]) ?>                                
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'jml_saudara')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'jarak_rumah')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-sekolah" role="tabpanel" aria-labelledby="nav-password-tab">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($model, 'nisn')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'nipd')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'skhun')->textInput(['autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'rombel_now')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'no_kps')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'no_peserta_ujian')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'no_seri_ijazah')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'nomor_kip')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'nama_di_kip')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'nomor_kks')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($model, 'layak_pip')->dropDownList(['Ya' => 'Ya','Tidak' => 'Tidak'],['autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'alasan_layak_pip')->textarea(['rows' => 6,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'kebutuhan_khusus')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="nav-bank" role="tabpanel" aria-labelledby="nav-bank-tab">
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'bank')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'no_rekening_bank')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'atas_nama_rekening')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                    </div>
                </div>
                <br>
                <!-- <div class="row">
                    <div class"text-left"><button id="start-camera" class="pull-left">Start Camera</button></div>
                </div> -->
            </div>
            <div class="tab-pane fade" id="nav-picture" role="tabpanel" aria-labelledby="nav-picture-tab">
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'nik_ayah')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'nama_ayah')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'tgl_lahir_ayah')->textInput(['autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'pendidikan_ayah')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'pekerjaan_ayah')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'penghasilan_ayah')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'nik_ibu')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'nama_ibu')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'tgl_lahir_ibu')->textInput(['autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'pendidikan_ibu')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'pekerjaan_ibu')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'penghasilan_ibu')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>

                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'nik_wali')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'nama_wali')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'tgl_lahir_wali')->textInput(['autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'pendidikan_wali')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'pekerjaan_wali')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'penghasilan_wali')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                    </div>
                </div>
                <br>
                <!-- <div class="row">
                    <div class"text-left"><button id="start-camera" class="pull-left">Start Camera</button></div>
                </div> -->
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
