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
            $("#nama_siswa").val(item.nama);
            $("#rombel_siswa").val(item.rombel);
            return item.id;
        }
	}
JS;

?>
<style>
    fieldset, legend {
        all: revert;
    }
    .table > thead {
        background-color: #4f5256;
        border : !important solid #4f5256;
    }
</style>
<div class="magang-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-4">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true,'readOnly' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= 
                        $form->field($model, 'tgl_mulai')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Tanggal Mulai...','autocomplete' => 'off'],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'allowClear' => true,
                                'format' => 'dd/mm/yyyy'
                            ]
                        ]);
                    ?>
                </div>
                <div class="col-sm-3">
                    <?= 
                        $form->field($model, 'tgl_akhir')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Tanggal Akhir...','autocomplete' => 'off'],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'allowClear' => true,
                                'format' => 'dd/mm/yyyy'
                            ]
                        ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <?=  $form->field($model, 'code_perusahaan')->widget(Select2::classname(), [
                        'data' => Perusahaan::find()->where(['status_data'=>1])->select(["concat('[',id_perusahaan,'] ',nama) text,id_perusahaan id,nama"])->indexBy("id_perusahaan")->column(),
                        'options' => ['placeholder' => 'Select Header Menu ...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'templateSelection' => new JsExpression($format1Selection),
                        ],
                    ]); ?>
                </div>
                <div class="col-sm-10">
                    <?= $form->field($model, 'pic')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-10">
            <fieldset style="border: 1 solid ">
                <legend>Data Siswa Magang</legend>
                <div class="row">
                    <table class="table table-striped table-bordered" id="tabel_detail" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th style='width: 5%;vertical-align: middle;text-align:center;color : #ced3d9;'>No.</th>
                                <th style='width: 18%;vertical-align: middle;text-align:center;color : #ced3d9;'>NISN</th>
                                <th style='vertical-align: middle;text-align:left;color : #ced3d9;'>Nama Siswa</th>
                                <th style='width: 20%;vertical-align: middle;text-align:center;color : #ced3d9;'>Romble</th>
                                <th style='width: 10%;vertical-align: middle;text-align:center;color : #ced3d9;'></th>
                            </tr>
                        </thead>
                        <tbody id="tbody"></tbody>
                        <tfoot>
                            <tr>
                                <th>#<input type="hidden" id="number" class="form-control" name="number" readOnly></th>
                                <th style="padding: 0 0 0 0;">
                                    <div class="form-group text_nisp">
                                        <?= 
                                            Select2::widget([
                                                'name' => 'text_nisp',
                                                'id' => 'text_nisp',
                                                'options' => [
                                                    'placeholder' => 'Select a Siswa...'
                                                ],
                                                'pluginOptions' => [
                                                    'placeholder' => 'Please select one',
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
                                        <div class="help-block"></div>
                                    </div>
                                </th>
                                <th style="padding: 0 0 0 0;">
                                    <div class="form-group nama_siswa">
                                        <input type="text" id="nama_siswa" class="form-control" name="nama_siswa" readOnly>
                                        <div class="help-block"></div>
                                    </div>
                                </th>
                                <th style="padding: 0 0 0 0;">
                                    <div class="form-group rombel_siswa">
                                        <input type="text" id="rombel_siswa" class="form-control" name="rombel_siswa" readOnly>
                                        <div class="help-block"></div>
                                    </div>
                                </th>
                                <th style="padding: 0 0 0 0;">
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
            </fieldset>
        </div>
    </div>
    <p class="text-right">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </p>
    <?php ActiveForm::end(); ?>

</div>
<script>
    $(document).ready(function(){
        $("#tbody").html(<?= isset($tbody) ? $tbody : '' ?>);
    });

    $("body").off("click","#create").on("click","#create",function(){
        var success = true;
        if($("#text_nisp").val() == ''){
            alert("Data siswa belum diisi");
            $("#text_nisp").focus();
            return false;
        }

        $('#tabel_detail > tbody  > tr').each(function(index, tr) { 
            var nisn = $(this).closest("tr").attr("data-nisn");
           
            if(nisn == $("#text_nisp").val() && $("#number").val() == ''){
                alert("Nomor NISN siswa sudah ada");
                $("#text_nisp").focus();
                success = false
            }
        });

        if(success == true){
            $.ajax({
                url: '<?= Url::to(['add-row-siswa'])?>',
                type:"POST",
                async:"false",
                data:{
                    number : $("#number").val(),
                    nisn : $("#text_nisp").val(),
                    nama : $("#nama_siswa").val(),
                    rombel : $("#rombel_siswa").val(),
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
            url: '<?= Url::to(['add-row-siswa'])?>',
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

    $("body").off("click",".btn-edit").on("click",".btn-edit",function(){
        var number = $(this).closest("tr").attr("data-no");

        $("#number").val(number);
        $("#text_nisp").val($("#nisn_"+number).val()).trigger('change');
        $("#nama_siswa").val($("#nama_"+number).val());
        $("#rombel_siswa").val($("#rombel_"+number).val());
        $("#create").css("width","40%");
        $("#cancel").show();
    });

    $("body").off("click","#cancel").on("click","#cancel",function(){
        clearForm();
    });

    function clearForm()
    {
        $("#number").val('');
        $("#text_nisp").val('').trigger('change');
        $("#nama_siswa").val('');
        $("#rombel_siswa").val('');
        $("#cancel").hide();
        $("#create").css("width","100%");
    }
</script>