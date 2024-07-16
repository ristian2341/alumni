<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
?>    

<div class="form-container">
	<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
		<?= $form->field($model, 'username')->textInput(['class' => 'form-control1','autofocus' => true,'autocomplete' => 'off']) ?>
		<?= $form->field($model, 'password', [
				'template' => '{input}
					<a class="plain-text" href="javascript:void(0)" data-button="plain_text">
						<span class="icon-eye-3"></span>
				</a>{error}{hint}'
			])->passwordInput(['autocomplete' => 'off','class' => 'form-control1']); ?>
		<?= $form->field($model, 'rememberMe')->checkbox([
			'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
		]) ?>
		<div class="form-group">
			<div class="button-wrapper">
				<div class="button-layer">
					<?= Html::submitButton('Login <i class="icon-login-3"></i>', ['class' => 'form-control btn btn-round btn-success', 'name' => 'login-button']) ?>
				</div>
			</div>
		</div>
	<?php ActiveForm::end(); ?>
	<div class="clearfix">&nbsp;</div>
</div>
