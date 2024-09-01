<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Url;    
use yii\web\JsExpression;


/** @var yii\web\View $this */
/** @var app\models\Lowker $model */
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
            $("#lowker-nama_perusahaan").val(item.nama);
            $("#lowker-email").val(item.email);
            $("#lowker-kontak").val(item.phone);
            $("#lowker-alamat").val(item.alamat);
            $("#lowker-kabupaten").val(item.kota);
            $("#lowker-propinsi").val(item.propinsi);
            return item.id;
        }else{
            $("#lowker-nama_perusahaan").val("");
            $("#lowker-email").val("");
            $("#lowker-kontak").val("");
            $("#lowker-alamat").val("");
            $("#lowker-kabupaten").val("");
            $("#lowker-propinsi").val("");
        }
	}
JS;

$this->registerJs(
   '
	$("#pjax_x").on("pjax:send", function() { // beforeSend
			// $("#loader").show();
            loadingbars("circle");
	})
	$("#pjax_x").on("pjax:complete", function() { // complete
		// retainCheckedSingle(); // ini harus di deklarasikan
		// setCheckedChooseAll(); // ini harus di deklarasikan
		// $("#loader").hide();
        loading.close();
	})
	'
);


?>

<div class="lowker-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'tgl_post')->widget(DatePicker::classname(), [
                                'options' => [
                                    'placeholder' => 'Tanggal Post...',
                                    'value' => date('d/m/Y'),
                                    'autocomplete' => 'off'
                                ],
                                'pluginOptions' => [
                                    'autoclose' => true
                                ]
                            ]); 
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'tgl_last')->widget(DatePicker::classname(), [
                                'options' => [
                                    'placeholder' => 'Tgl Akhir Lowker...',
                                    'value' => date('d/m/Y',strtotime("+1 month",strtotime(date('Y-m-d')))),
                                    'autocomplete' => 'off'
                                ],
                                'pluginOptions' => [
                                    'autoclose' => true
                                ]
                            ]); 
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'lowongan')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <?php if($model->isNewRecord): ?>
                            <?= $form->field($model,'id_perusahaan')->widget(Select2::className(),[
                                'options' => [
                                        'autocomplete'=>'off',
                                    ],
                                    'pluginOptions' => [
                                        'placeholder' => 'Please select one',
                                        'allowClear' => true,
                                        'ajax' => [
                                            'url' => Url::to(['data-perusahaan']),
                                            'dataType' => 'json',
                                            'type' => 'post',
                                            'data' => new JsExpression('function(params) { return {q:params.term};}'),
                                            'processResults' => new JsExpression($resultsJs),
                                        ],
                                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                        'templateResult' => new JsExpression($format1line),
                                        'templateSelection' => new JsExpression($format1Selection),
                                    ],
                                ]); ?>  
                        <?php else: ?>
                            <?= $form->field($model, 'id_perusahaan')->textInput(['maxlength' => true,'readOnly' => true,'autocomplete' => 'off']); ?>
                        <?php endif; ?>    
                    </div>
                    <div class="col-sm-8">
                        <?= $form->field($model, 'nama_perusahaan')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <?= $form->field($model, 'alamat')->textArea(['maxlength' => true,'autocomplete' => 'off']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'kabupaten')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'propinsi')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'kontak')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'requirement')->textarea(['rows' => 6,'autocomplete' => 'off']) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'keterangan')->textarea(['rows' => 6,'autocomplete' => 'off'   ]) ?>  
            </div>
        </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    <?php if(!$model->isNewRecord): ?>
        $("#lowker-lowker-id_perusahaan").attr("disabled",true);
        $("#lowker-nama_perusahaan").attr("disabled",true);
    <?php endif; ?>
</script>