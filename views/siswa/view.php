<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Siswa $model */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Siswas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<style>
   
    legend {
        background-color: gray;
        color: white;
        padding: 2px 4px;
    }

    input {
        margin: 5px;
    }

    th, td {
        font-size: 14px;
    }
</style>
<div class="siswa-view">
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'code' => $model->code], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'code' => $model->code], [
            'class' => 'btn btn-sm btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <fieldset>
        <legend>Data Siswa</legend>
        <div class="row">
            <div class="col-sm-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'code',
                        'nik',
                        'nama',
                        [
                            'attribute' => 'jen_kelamin',
                            'value' => ($model->jen_kelamin == 'L') ? 'Laki-Laki' : 'Perempuan',
                        ],
                        'tempat_lahir',
                        [
                            'attribute' => 'tgl_lahir',
                            'value' => isset($model->tgl_lahir) ? date('d/m/Y',strtotime($model->tgl_lahir)) : "",
                        ],
                        'phone',
                        'handphone',
                        'email:email',
                        'no_akta_lahir',
                    ],
                ]) ?>
            </div>
            <div class="col-sm-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'alamat',
                        [
                            'label' => 'RT / RW',
                            'value' => (!empty($model->rt) ? $model->rt : '') ." / ". (!empty($model->rw) ? $model->rw : ''),
                        ],
                        'dusun',
                        'kelurahan',
                        'kecamatan',
                        // 'kabupaten',
                        'kode_pos',
                        'jenis_tinggal',
                        'alat_transportasi',
                    ],
                ]) ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Data Siswa</legend>
        <div class="row">
            <div class="col-sm-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'nisn',
                        'nipd',
                        'skhun',
                        'no_kps',
                        'no_peserta_ujian',
                        'no_seri_ijazah',
                        'tahun_lulus',
                        [
                            'attribute' => 'id_status_lulus',
                            'label' => 'Setelah Lulus',
                            'value' => isset($model->statusSiswa) ? $model->statusSiswa : '',
                        ],
                        [
                            'attribute' => 'code_jurusan',
                            'label' => 'Jurusan',
                            'value' => isset($model->jurusan->nama) ? $model->jurusan->nama : '',
                        ],
                    ],
                ]) ?>
            </div>
            <div class="col-sm-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'rombel_now',
                        'nomor_kip',
                        'nama_di_kip',
                        'nomor_kks',
                        'layak_pip',
                        'alasan_layak_pip:ntext',
                    ],
                ]) ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Data Wali</legend>
        <div class="row">
            <div class="col-sm-4">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'nik_ayah',
                        'nama_ayah',
                        'tgl_lahir_ayah',
                        'pendidikan_ayah',
                        'pekerjaan_ayah',
                        'penghasilan_ayah',
                    ],
                ]) ?>
            </div>
            <div class="col-sm-4">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'nik_ibu',
                        'nama_ibu',
                        'tgl_lahir_ibu',
                        'pendidikan_ibu',
                        'pekerjaan_ibu',
                        'penghasilan_ibu',
                    ],
                ]) ?>
            </div>
            <div class="col-sm-4">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'nik_wali',
                        'nama_wali',
                        'tgl_lahir_wali',
                        'pendidikan_wali',
                        'pekerjaan_wali',
                        'penghasilan_wali',
                    ],
                ]) ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Data Bank Siswa</legend>
        <div class="row">
            <div class="col-sm-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'bank',
                        'no_rekening_bank',
                        'atas_nama_rekening',
                    ],
                ]) ?>
            </div>
            <div class="col-sm-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'rombel_now',
                        'nomor_kip',
                        'nama_di_kip',
                        'nomor_kks',
                        'layak_pip',
                        'alasan_layak_pip:ntext',
                    ],
                ]) ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Data Siswa</legend>
        <div class="row">
            <div class="col-sm-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                       'kebutuhan_khusus',
                        'sekolah_asal',
                        'anak_keberapa',
                        'lintang',
                        'bujur',
                        'no_kk',
                        'berat_badan',
                        'tinggi_badan',
                        'lingkar_kepala',
                        'jml_saudara',
                        'jarak_rumah',
                    ],
                ]) ?>
            </div>
        </div>
    </fieldset>
</div>
