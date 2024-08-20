<?php

use app\models\Siswa;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\SiswaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Siswas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Siswa'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'nipd',
            'nisn',
            'nik',
            'nama',
            //'jen_kelamin',
            //'tempat_lahir',
            //'tgl_lahir',
            //'alamat',
            //'rt',
            //'rw',
            //'dusun',
            //'kelurahan',
            //'kecamatan',
            //'kabupaten',
            //'kode_pos',
            //'jenis_tinggal',
            //'alat_transportasi',
            //'phone',
            //'handphone',
            //'email:email',
            //'skhun',
            //'no_kps',
            //'nama_ayah',
            //'tgl_lahir_ayah',
            //'pendidikan_ayah',
            //'pekerjaan_ayah',
            //'penghasilan_ayah',
            //'nik_ayah',
            //'nama_ibu',
            //'tgl_lahir_ibu',
            //'pendidikan_ibu',
            //'pekerjaan_ibu',
            //'penghasilan_ibu',
            //'nik_ibu',
            //'nama_wali',
            //'tgl_lahir_wali',
            //'pendidikan_wali',
            //'pekerjaan_wali',
            //'penghasilan_wali',
            //'nik_wali',
            //'rombel_now',
            //'no_peserta_ujian',
            //'no_seri_ijazah',
            //'nomor_kip',
            //'nama_di_kip',
            //'nomor_kks',
            //'no_akta_lahir',
            //'bank',
            //'no_rekening_bank',
            //'atas_nama_rekening',
            //'layak_pip',
            //'alasan_layak_pip:ntext',
            //'kebutuhan_khusus',
            //'sekolah_asal',
            //'anak_keberapa',
            //'lintang',
            //'bujur',
            //'no_kk',
            //'berat_badan',
            //'tinggi_badan',
            //'lingkar_kepala',
            //'jml_saudara',
            //'jarak_rumah',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Siswa $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'code' => $model->code]);
                 }
            ],
        ],
    ]); ?>


</div>
