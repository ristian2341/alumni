<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\web\JsExpression;
use app\models\Perusahaan;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var app\modules\magang\models\Magang $model */
/** @var yii\widgets\ActiveForm $form */


$resultsJs = <<< JS
    function (data, params) {
       // params.page = params.page || 1;

        return {
            // Change `data.items` to `data.results`.
            // `results` is the key that you have been selected on
            // `actionJsonlist`.
			
            results: data.results
        };
    }
JS;

$format1line = <<< JS
	function (item) {
		var selectionText = item.text.split(";");
        string="";
        if(typeof(selectionText[0]) != "undefined" && selectionText[0] !== null) {
            string=selectionText[0];
        }
        string2="";
        if(typeof(selectionText[1]) != "undefined" && selectionText[1] !== null) {
            string2=selectionText[1];
        }
        
		// var returnString = '<span style="font-weight:bold;font-size:11px;">'+selectionText[0]+'</span><span style="font-size:11px;">'+selectionText[1]+'</span>';
		var returnString = '<span style="font-weight:bold;font-size:11px;">'+string+'</span><span style="font-size:11px;">'+string2+'</span>';
		return returnString;
	}
JS;

$format1Selection = <<< JS
	function (item) {
        if(item.id){
            getDataSiswa(item.id);
            return item.id;
        }
	}
JS;

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
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'validate-form'], 'validateOnSubmit' => true]); ?>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-row-12">
                        <?php if(empty($model->nisn)):?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($model, 'nisn')->widget(Select2::classname(), [
                                            'options' => ['placeholder' => 'Select Header Menu ...'],
                                            'pluginOptions' => [
                                                'allowClear' => true,
                                                'ajax' => [
                                                    'url' => Url::to(['autocomplete-siswa']),
                                                    'dataType' => 'json',
                                                    'type' => 'post',
                                                    'data' => new JsExpression('function(params) { return {q:params.term};}'),
                                                    'processResults' => new JsExpression($resultsJs),
                                                ],
                                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                                'templateResult' => new JsExpression($format1line),
                                                'templateSelection' => new JsExpression($format1Selection),
                                            ],
                                        ]);
                                    ?>
                                </div>
                            </div>
                        <?php endif;?>
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($model, 'nik')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-8">
                                <?= $form->field($model, 'nama')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <?= $form->field($model, 'jen_kelamin')->dropDownList(['L' => 'Laki-Laki','P' => 'Perempuan'],['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'tgl_lahir')->widget(DatePicker::classname(), [
                                    'options' => [
                                        'placeholder' => 'Tgl Lahir...',
                                        'value' => isset($model->tgl_lahir) ? date('d/m/Y',strtotime($model->tgl_lahir)) : '',
                                        'autocomplete' => 'off'
                                    ],
                                    'pluginOptions' => [
                                        'autoclose' => true
                                    ]
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($model, 'handphone')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'whatsapp')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'email')->textInput(['maxlength' => true,'autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-12">
                                <?= $form->field($model, 'sosial_media')->textArea(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <?= $form->field($model, 'alamat')->textArea(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <?= $form->field($model, 'rt')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($model, 'rw')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($model, 'kode_pos')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($model, 'dusun')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'kelurahan')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <?= $form->field($model, 'kecamatan')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($model, 'jenis_tinggal')->dropDownList(['Bersama orang tua' => "Bersama orang tua","Rumah Sendiri" => "Rumah Sendiri","Kost" => "Kost","Kontrak" => "Kontrak"],['maxlength' => true,'autocomplete' => 'off']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <?= $form->field($model, 'id_status_siswa')->dropDownList($status_siswa,['autocomplete' => "off"]) ?>
                            </div>
                        </div>
                        <div class="row" id="kuliah">
                            <div class="col-sm-12">
                                <?= $form->field($model, 'jurusan_kuliah')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-12">
                                <?= $form->field($model, 'nama_universitas')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                        </div>
                        <div class="row" id="wiraswasta">
                            <div class="col-sm-12">
                                <?= $form->field($model, 'jenis_usaha')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-12">
                                <?= $form->field($model, 'lokasi_usaha')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                        </div>
                        <div class="row" id="bekerja">
                            <div class="col-sm-12">
                                <?= $form->field($model, 'perusahaan')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-12">
                                <?= $form->field($model, 'alamat_perusahaan')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'jabatan')->textInput(['autocomplete' => "off"]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'mulai_bekerja')->widget(DatePicker::classname(), [
                                    'options' => [
                                        'placeholder' => 'Mulai Bekerja...',
                                        'value' => isset($model->mulai_bekerja) ? date('d-m-Y',strtotime($model->mulai_bekerja)) : '',
                                        'autocomplete' => 'off'
                                    ],
                                    'pluginOptions' => [
                                        'autoclose' => true
                                    ]
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1">
                        &nbsp;
                    </div>
                    <div class="col-sm-10">
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
                            <?php if(isset($model->foto)): ?>
                                <div class="col-sm-6">
                                    <img src="<?= $model->foto; ?>" class="img-block" alt="User Image">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    $(document).ready(function(){
        $(".m-0").html('Data Profile');
        $("#kuliah").hide();
        $("#wiraswasta").hide();
        $("#bekerja").hide();
        
        var elem = $("#siswa-id_status_siswa option:selected").text();
        if(elem == 'Kuliah'){
            $("#kuliah").show();
        }

        if(elem== 'Wiraswasta'){
            $("#wiraswasta").show();
        }

        if(elem == 'Bekerja'){
            $("#bekerja").show();
        }
    });
    
    document.getElementById('siswa-file').onchange = function(e) { 
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

    $("body").off("change","#siswa-id_status_siswa").on("change","#siswa-id_status_siswa",function(){
        var elem = $("#siswa-id_status_siswa option:selected").text();
        $("#kuliah").hide();
        $("#wiraswasta").hide();
        $("#bekerja").hide();
        
        if(elem == 'Kuliah'){
            $("#kuliah").show();
        }
        if(elem== 'Wiraswasta'){
            $("#wiraswasta").show();
        }
        if(elem == 'Bekerja'){
            $("#bekerja").show();
        }
    });

    function getDataSiswa(nisn)
    {
        $.ajax({
			type: 'POST',
			url: "<?= Url::to(['siswa/profile-update'])?>",
            dataType: 'text',
			data :
            {
                'code' : nisn,
            },
            success : function(data)
            {
                if(data !== '')
                {
                    var res=$.parseJSON(data);
                    console.log(res);
                    $('#render_content').html(res);
                }
            }
		});	
    }
</script>
