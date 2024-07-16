<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);

// modal setting //
use app\models\Setting;
$setting = Setting::find()->where(['id_setting' => 1])->one();

$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/'.$setting->icon)]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta charset="<?= Yii::$app->charset ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($setting->nama_aplikasi) ?></title>
		<?php $this->head() ?>	
	</head>
	<style>
		.form-control1 {
			display: block;
			width: 100%;
			height: calc(1.5em + 0.75rem + 2px);
			padding: 0.375rem 0.75rem;
			font-size: 1rem;
			font-weight: 400;
			line-height: 1.5;
			color: #495057;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #646a70;
			border-radius: 0.25rem;
			transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
		}
	</style>
	<body>
	<?php $this->beginBody(['class' => 'login']) ?>
	<div class="login-wrapper">
		<div class="login-container">
			<div class="col-sm-12" style="text-align: center;">
				<img src="<?= isset($setting->logo) ? Url::base()."/".$setting->logo : ''?>" class="brand-image img-circle elevation-3" style="width: 150px;height: 150px;border: 1px;" alt="logo">
				<h2 style='color: black;'><?= (!empty($setting->instansi) ? $setting->instansi : '') ?></h2>
			</div>
			<?= $content ?>
		</div>
	</div>
	<?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>

<script>
$(document).ready(function(){
	$("body").off("click","[data-button=\"plain_text\"]").on("click","[data-button=\"plain_text\"]", function(e){
		e.preventDefault();
		$("#loginform-password").toggleClass("open-text");
		if($("#loginform-password").hasClass("open-text")){
			$("#loginform-password").attr("type", "text");
			$(".icon-eye-3").removeClass("icon-eye-3").addClass("icon-eye-off");
		} else{
			$("#loginform-password").attr("type", "password");
			$(".fa-eye-slash").removeClass("fa-eye-slash").addClass("fa-eye");
		}
	});
});
</script>