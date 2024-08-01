<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Setting $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="setting-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'instansi')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'alamat_instansi')->textArea(['maxlength' => true]) ?>
            <?= $form->field($model, 'kabupaten')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'profinsi')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'nama_aplikasi')->textInput(['maxlength' => true]) ?>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'email_notif')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-6">
                    <label class="control-label" for="setting-email_notif">Password Email Notification</label>
                    <?= $form->field($model, 'password_email', [
                        'template' => '{input}
                            <a class="plain-text" href="javascript:void(0)" data-button="plain_text" style="top: 40px; right: 12px;">
                                <span class="icon-eye-3"></span>
                        </a>{error}{hint}'
                    ])->passwordInput(['autocomplete' => 'off'])->label("Password Email"); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-6">
                    <img src="<?= !empty($model->logo) ? $model->logo : ''; ?>" width="260" height="250" class="img-block" alt="User Image">
                </div>
                <div class="col-sm-6">
                    <div id="gallery" width="320" height="240" class="canvas">
                        <canvas id="canv" width="275" height="183"></canvas>
                    </div>
                    <div class="row">
                    <?= $form->field($model, 'file_logo')->fileInput()->label(false); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
$(document).ready(function(){
	$("body").off("click","[data-button=\"plain_text\"]").on("click","[data-button=\"plain_text\"]", function(e){
		e.preventDefault();
        console.log('aaaaa');
		$("#setting-password_email").toggleClass("open-text");
		if($("#setting-password_email").hasClass("open-text")){
			$("#setting-password_email").attr("type", "text");
			$(".icon-eye-3").removeClass("icon-eye-3").addClass("icon-eye-off");
		} else{
			$("#setting-password_email").attr("type", "password");
			$(".fa-eye-slash").removeClass("fa-eye-slash").addClass("fa-eye");
		}
	});
});
</script>