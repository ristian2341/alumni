<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\web\JsExpression;
use app\models\Perusahaan;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var app\modules\curiculumvitae\models\CvSiswa $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    .table > thead {
        background-color: #4f5256;
        border : !important solid #4f5256;
        color : white;
    }

    .uppercase{
        text-transform: uppercase;
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
<div class="cv-siswa-form">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'code')->hiddenInput(['maxlength' => true])->label(false) ?>
        <?= $form->field($model, 'nik')->hiddenInput(['maxlength' => true,'readOnly' => true])->label(false) ?>
        <div class="card">
            <div class="row">
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-sm-12">
                            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <?= $form->field($model, 'jenis_kelamin')->dropdownlist(['laki-laki' => 'Laki - Laki','perempuan' => 'Perempuan'],['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'tanggal_lahir')->widget(DatePicker::classname(), [
                                    'options' => [
                                        'placeholder' => 'Tanggal Lahir...',
                                        'value' =>  (!empty($model->tanggal_lahir) && ($model->tanggal_lahir != '0000-00-00'))  ? date('d/m/Y',strtotime($model->tanggal_lahir)) : '',
                                        'autocomplete' => 'off'
                                    ],
                                    'pluginOptions' => [
                                        'autoclose' => true
                                    ]
                                ]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'kontak')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?= $form->field($model, 'alamat_tinggal')->textArea(['rows' => 4]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div id="gallery" width="230" height="250" class="canvas">
                                    <canvas id="canv" width="230" height="250"></canvas>
                                </div>
                            </div>
                            <div class="row">
                                <?= $form->field($model, 'file')->fileInput()->label(false); ?>
                            </div>
                        </div>
                        <?php if(isset($model->path_foto)): ?>
                            <div class="col-sm-6">
                                <img src="<?= $model->path_foto; ?>" class="img-block" alt="User Image">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-9">
                            <label for="font-12">Pendidikan</label>
                            <table class="table table-striped table-bordered" cellspacing="0" cellpadding="0">
                                <thead class="text-center">
                                    <th style="width:3%;">No.</th>
                                    <th style="width:35%;">Pendidikan</th>
                                    <th style="width:25%;">Jurusan</th>
                                    <th>Periode</th>
                                    <th style="width:10%;">action</th>
                                </thead>
                                <tbody id="tbody"></tbody>
                                <tfoot>
                                    <tr>
                                        <th style="padding: 0 0 0 0;">
                                            #<input type="hidden" id="number" class="form-control" name="number" readOnly>
                                        </th>
                                        <th style="padding: 0 0 0 0;">
                                            <input type="text" id="cvpendidikan-sekolah" class="form-control uppercase" value="" maxlength="100" aria-invalid="false">
                                        </th>
                                        <th style="padding: 0 0 0 0;">
                                            <input type="text" id="cvpendidikan-jurusan" class="form-control uppercase" value="" maxlength="100" aria-invalid="false">
                                        </th>
                                        <th style="padding: 0 0 0 0;">
                                            <div class="input-group mb-3">
                                                <input type="text" id="cvpendidikan-periode1" class="form-control uppercase" value="" maxlength="100" aria-invalid="false">
                                                <span class="input-group-text">-</span>
                                                <input type="text" id="cvpendidikan-periode2" class="form-control uppercase" value="" maxlength="100" aria-invalid="false">
                                            </div>
                                        </th>
                                        <th style="padding: 0 0 0 0;text-align: center;">
                                            <button class="btn btn-success create" type="button" id="create" style="width: 100%;position: relative;">
                                                <span class="fa icon-plus"></span>
                                            </button>
                                            <button class="btn btn-danger" type="button" id="cancel" style="width: 40%;display: none;position: relative;">
                                                <span class="fa icon-cancel"></span>
                                            </button>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-sm-9">
                            <label for="font12">Pengalaman Kerja</label>
                            <table class="table table-striped table-bordered" cellspacing="0" cellpadding="0">
                                <thead class="text-center">
                                    <th style="width:3%;">No.</th>
                                    <th style="width:30%;">Nama Perusahaan</th>
                                    <th style="width:25%;">Jabatan</th>
                                    <th colspan='2'>Periode</th>
                                    <th style="width:10%;">action</th>
                                </thead>
                                <tbody id="tbody_pengalaman"></tbody>
                                <tfoot>
                                    <tr>
                                        <th style="padding: 0 0 0 0;">
                                            #<input type="hidden" id="number_pengalaman" class="form-control" name="number_pengalaman" readOnly>
                                        </th>
                                        <th style="padding: 0 0 0 0;">
                                            <input type="text" id="cvpengalaman-perusahaan" class="form-control uppercase" value="" maxlength="100" aria-invalid="false">
                                        </th>
                                        <th style="padding: 0 0 0 0;">
                                            <input type="text" id="cvpengalaman-jabatan" class="form-control uppercase" value="" maxlength="100" aria-invalid="false">
                                        </th>
                                        <th style="padding: 0 0 0 0;">
                                            <input type="text" id="cvpengalaman-tahun1" class="form-control uppercase" value="" maxlength="100" aria-invalid="false">
                                        </th>
                                        <th style="padding: 0 0 0 0;">
                                            <input type="text" id="cvpengalaman-tahun2" class="form-control uppercase" value="" maxlength="100" aria-invalid="false">
                                        </th>
                                        <th style="padding: 0 0 0 0;text-align: center;">
                                            <button class="btn btn-success create" type="button" id="create_pengalaman" style="width: 100%;position: relative;">
                                                <span class="fa icon-plus"></span>
                                            </button>
                                            <button class="btn btn-danger" type="button" id="cancel_pengalaman" style="width: 40%;display: none;position: relative;">
                                                <span class="fa icon-cancel"></span>
                                            </button>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'kemampuan')->textarea(['rows' => 6]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'hobi')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('<span class="fa icon-floppy"></span> Save', ['class' => 'btn btn-success']) ?>
            <?= Html::a('<span class="fa icon-print"></span> Print CV', ['print-cv', 'code' => $model->code ], ['class' => 'btn btn-info', 'target'=>'_blank', 'title' => 'Export to PDF']); ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    $(document).ready(function(){
        loadTable();
        loadPengalaman();
    });

    function loadTable()
	{	
		$.ajax({
			url: '<?= Url::to(['load-temp-table'])?>',
			dataType: "html",
			async:"false",
			success: function(data) 
			{
                $("#tbody").html(data);
			},
		});
	}

    function loadPengalaman()
	{	
		$.ajax({
			url: '<?= Url::to(['load-temp-pengalaman'])?>',
			dataType: "html",
			async:"false",
			data:{
                <?php if(isset($proses)): ?>
                    proses : '<?=$proses?>',
                <?php endif; ?>
                code_spm : $("#deliveryorder-code_spm").val(),
            },
			success: function(data) 
			{
                $("#tbody_pengalaman").html(data);
			},
		});
	}

    $("body").off("click","#create").on("click","#create",function(){
        var success = true;
        if(success == true){
            $.ajax({
                url: '<?= Url::to(['add-row-pendidikan'])?>',
                type:"POST",
                async:"false",
                data:{
                    number : $("#number").val(),
                    sekolah : $("#cvpendidikan-sekolah").val(),
                    jurusan : $("#cvpendidikan-jurusan").val(),
                    periode1 : $("#cvpendidikan-periode1").val(),
                    periode2 : $("#cvpendidikan-periode2").val(),
                    action : 'add',
                },
                success: function(data) 
                {
                    $("#tbody").html(data);
                    clearForm();
                    $("#cancel").hide();
                },
            });
        }
    });

    $("body").off("click","#btn-delete").on("click","#btn-delete",function(){
        var number = $(this).closest("tr").attr("data-no");
        $.ajax({
            url: '<?= Url::to(['add-row-pendidikan'])?>',
            type:"POST",
            async:"false",
            data:{
                number : number,
                action : 'delete',
            },
            success: function(data) 
            {
                $("#tbody").html(data);
                clearForm();
            },
        });
    });

    $("body").off("click","#btn-delete_pengalaman").on("click","#btn-delete_pengalaman",function(){
        var number = $(this).closest("tr").attr("data-no_pengalaman");
        $.ajax({
            url: '<?= Url::to(['add-row-pengalaman'])?>',
            type:"POST",
            async:"false",
            data:{
                number : number,
                action : 'delete',
            },
            success: function(data) 
            {
                $("#tbody_pengalaman").html(data);
                clearFormPengalaman();
            },
        });
    });

    $("body").off("click",".btn-edit").on("click",".btn-edit",function(){
        var number = $(this).closest("tr").attr("data-no");
        var sekolah = $(this).closest("tr").attr("data-sekolah");
        var jurusan = $(this).closest("tr").attr("data-jurusan");
        var periode1 = $(this).closest("tr").attr("data-periode1");
        var periode2 = $(this).closest("tr").attr("data-periode2");
        $("#number").val(number);
        $("#cvpendidikan-sekolah").val(sekolah);
        $("#cvpendidikan-jurusan").val(jurusan);
        $("#cvpendidikan-periode1").val(periode1);
        $("#cvpendidikan-periode2").val(periode2);
        $("#create").css("width","40%");
        $("#cancel").show();
    });

    $("body").off("click","#cancel").on("click","#cancel",function(){
        clearForm();
    });

    $("body").off("click","#cancel_pengalaman").on("click","#cancel_pengalaman",function(){
        clearFormPengalaman();
    });

    function clearForm()
    {
        $("#number").val('');
        $("#cvpendidikan-sekolah").val('');
        $("#cvpendidikan-jurusan").val('');
        $("#cvpendidikan-periode1").val('');
        $("#cvpendidikan-periode2").val('');
        $("#cancel").hide();
        $("#create").css("width","100%");
    }

    document.getElementById('cvsiswa-file').onchange = function(e) { 
        let img = new Image();
        img.onload = draw;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
    };

    function draw() {
        let canvas = document.getElementById('canv'),
        ctx = canvas.getContext('2d');
        ctx.drawImage(this, 0, 0);
        document.getElementById('gallery').append(canvas);
    }

    function failed() {
        console.error("The provided file couldn't be loaded as an Image media");
    }

    $("body").off("click","#create_pengalaman").on("click","#create_pengalaman",function(){
        var success = true;
        if(success == true){
            $.ajax({
                url: '<?= Url::to(['add-row-pengalaman'])?>',
                type:"POST",
                async:"false",
                data:{
                    number : $("#number_pengalaman").val(),
                    perusahaan : $("#cvpengalaman-perusahaan").val(),
                    jabatan : $("#cvpengalaman-jabatan").val(),
                    tahun1 : $("#cvpengalaman-tahun1").val(),
                    tahun2 : $("#cvpengalaman-tahun2").val(),
                    action : 'add',
                },
                success: function(data) 
                {
                    $("#tbody_pengalaman").html(data);
                    clearFormPengalaman();
                    $("#cancel").hide();
                },
            });
        }
    });

    function clearFormPengalaman()
    {
        $("#number_pengalaman").val('');
        $("#cvpengalaman-perusahaan").val('');
        $("#cvpengalaman-jabatan").val('');
        $("#cvpengalaman-tahun1").val('');
        $("#cvpengalaman-tahun2").val('');
        $("#cancel_pengalaman").hide();
        $("#create_pengalaman").css("width","100%");
    }

    $("body").off("click",".btn-edit_pengalaman").on("click",".btn-edit_pengalaman",function(){
        var number = $(this).closest("tr").attr("data-no_pengalaman");
        var perusahaan = $(this).closest("tr").attr("data-perusahaan");
        var jabatan = $(this).closest("tr").attr("data-jabatan");
        var tahun1 = $(this).closest("tr").attr("data-tahun1");
        var tahun2 = $(this).closest("tr").attr("data-tahun2");
        $("#number_pengalaman").val(number);
        $("#cvpengalaman-perusahaan").val(perusahaan);
        $("#cvpengalaman-jabatan").val(jabatan);
        $("#cvpengalaman-tahun1").val(tahun1);
        $("#cvpengalaman-tahun2").val(tahun2);
        $("#create_pengalaman").css("width","40%");
        $("#cancel_pengalaman").show();
    });

    $("body").off("click","#btn-print").on("click","#btn-print",function(){
        $.ajax({
            url: '<?= Url::to(['add-row-pengalaman'])?>',
            type:"POST",
            async:"false",
            data:{
                number : $("#number_pengalaman").val(),
                perusahaan : $("#cvpengalaman-perusahaan").val(),
                jabatan : $("#cvpengalaman-jabatan").val(),
                tahun1 : $("#cvpengalaman-tahun1").val(),
                tahun2 : $("#cvpengalaman-tahun2").val(),
                action : 'add',
            },
            success: function(data) 
            {
                $("#tbody_pengalaman").html(data);
                clearFormPengalaman();
                $("#cancel").hide();
            },
        });
    });
</script>
