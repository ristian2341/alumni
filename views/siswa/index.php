<?php

use app\models\Siswa;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use yii\widgets\ActiveForm;
use app\modules\master\models\Jurusan;


/** @var yii\web\View $this */
/** @var app\models\SiswaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Siswa ');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .modal{
        top: 60px;
    }
</style>
<div class="siswa-index">
    <p>
        <?php if(Yii::$app->user->identity->admin || Yii::$app->user->identity->developer): ?>
            <button type="button" id="btn-upload" class="btn btn-success btn-sm btn-flat"><span class='fas fa-upload'></span> Upload File</button>
        <?php endif; ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered custom-dataTable dataTable'],
        'pager' => [
            'class' => 'yii\bootstrap4\LinkPager',
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'code',
            // 'nipd',
            [
                'headerOptions' => ['style' => 'width:150px;'],
                'attribute'=>'nisn',
            ],
            [
                'headerOptions' => ['style' => 'width:250px;'],
                'attribute' =>  'code_jurusan',
                'filter' => Jurusan::find()->where(['status_data' => 1])->select("nama")->indexBy('code')->column(),
                'value' => function($model){
                    return !empty($model->jurusan->nama) ? $model->jurusan->nama : '';
                }
            ],
            [
                'headerOptions' => ['style' => 'width:170px;'],
                'attribute'=>  'nik',
            ],
            'nama',
            [
                'headerOptions' => ['style' => 'width:170px;'],
                'attribute' => 'jen_kelamin',
                'filter' => ['L' => 'Laki - Laki','P' => 'Perempuan'],
                'value' => function($model){
                    return ($model->jen_kelamin == 'L') ?  'Laki-Laki' : 'Perempuan';
                }
            ],
          
            // 'tgl_lahir',
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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {profile-update}',
                'buttons' => [
                    'view' => function($url, $model){
                        return HTML::a("<span class='fas fa-eye'></span>", Url::toRoute(['view', 'code' => $model->code]),[
                            'class' => 'btn btn-info btn-xs',
                        ]);
                    },
                    'update' => function($url, $model){
                        if(!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('data_siswa')->update)){
                            return HTML::a("<span class='fas fa-pencil-alt'></span>",Url::toRoute(['update', 'code' => $model->code]), [
                                'class' => 'btn btn-warning btn-xs',
                                'title' => 'Update',
                            ]);
                        }
                    },
                    'profile-update' => function($url, $model){
                        if(!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('data_siswa')->delete)){
                            return Html::a("<span class='fas fa-check'></span>", '#', [
                                'class' => 'btn btn-primary btn-xs',
                                'onclick' => "
                                if (confirm('Are you sure ?')) {
                                    $.ajax('".Url::toRoute(['profile-update', 'nisn' => $model->nisn])."', {
                                        type: 'POST'
                                    }).done(function(data) {
                                        $.pjax.reload({container: '#'});
                                    });
                                }
                                return false;
                                ",
                            ]);
                        }
                    },
                    'delete' => function($url, $model){
                        if(!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('data_siswa')->delete)){
                            return Html::a("<span class='fas fa-trash'></span>", '#', [
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "
                                if (confirm('Are you sure ?')) {
                                    $.ajax('".Url::toRoute(['delete', 'code' => $model->code])."', {
                                        type: 'POST'
                                    }).done(function(data) {
                                        $.pjax.reload({container: '#list_bast_checkin'});
                                    });
                                }
                                return false;
                                ",
                            ]);
                        }
                    },
                ],
                'contentOptions'=> [
                    'style'=>'width: 150px'
                ],
            ],
        ],
    ]); ?>
</div>


<!-- MODAL Detail -->
<?php Modal::begin([
        'title' => 'Upload Data Siswa (File Excel)',
		'options' => [
			'id' => 'modal_upload',
			'tabindex' => false
		],
	]);
?>
    <?php $form = ActiveForm::begin(['id' => 'file-upload-form', 'options' => ['enctype' => 'multipart/form-data']]) ?>
        <div class="modal-body">
            <input type="file" id="file_excel" name="file_upload" accept="text/plain, .csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
        </div>
        <div class="text-right">
            <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success btn-sm btn-flat" id="btn-save">Upload</button>
        </div>
    <?php ActiveForm::end(); ?>
<?php  Modal::end(); ?>

<script>
    $("body").off("click","#btn-upload").on("click","#btn-upload",function(){
        $("#file_excel").val('');
        $("#modal_upload").modal("show");
    }); 

    $("body").off("click","#btn-save").on("click","#btn-save",function(){
        var formdata = new FormData($("#file-upload-form")[0]);
        console.log(formdata);
        $.ajax({
            url: "<?= Url::to(['import-excel'])?>",
            dataType: "json",
            type: "post",
            data: formdata,
            contentType: false, // Not to set any content header
            processData: false, // Not to process data
            success: function (result) {
                alert(result.data['message']);
            },
            error: function (xhr, status, error) {
                alert(status);
            }
        });

    });
</script>