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
<div class="siswa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'code' => $model->code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'code' => $model->code], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'code',
            'nipd',
            'nisn',
            'nik',
            'nama',
            'jen_kelamin',
            'tempat_lahir',
            'tgl_lahir',
            'alamat',
            'rt',
            'rw',
            'dusun',
            'kelurahan',
            'kecamatan',
            'kabupaten',
            'kode_pos',
            'jenis_tinggal',
            'alat_transportasi',
            'phone',
            'handphone',
            'email:email',
            'skhun',
            'no_kps',
            'nama_ayah',
            'tgl_lahir_ayah',
            'pendidikan_ayah',
            'pekerjaan_ayah',
            'penghasilan_ayah',
            'nik_ayah',
            'nama_ibu',
            'tgl_lahir_ibu',
            'pendidikan_ibu',
            'pekerjaan_ibu',
            'penghasilan_ibu',
            'nik_ibu',
            'nama_wali',
            'tgl_lahir_wali',
            'pendidikan_wali',
            'pekerjaan_wali',
            'penghasilan_wali',
            'nik_wali',
            'rombel_now',
            'no_peserta_ujian',
            'no_seri_ijazah',
            'nomor_kip',
            'nama_di_kip',
            'nomor_kks',
            'no_akta_lahir',
            'bank',
            'no_rekening_bank',
            'atas_nama_rekening',
            'layak_pip',
            'alasan_layak_pip:ntext',
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
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
