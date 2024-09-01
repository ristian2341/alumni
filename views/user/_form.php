<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\GroupMenu;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'full_name')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                <?= $form->field($model, 'type_akun')->textInput(['maxlength' => true,'autocomplete' => 'off','readonly' => true, 'value' => 'user']) ?>
                <?= $form->field($model, 'approval')->checkBox() ?>
                <?= $form->field($model, 'admin')->checkBox() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'username')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                <?= $form->field($model, 'password_new')->passwordInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                <?= $form->field($model, 'id_group')->dropDownList(
                    GroupMenu::find()->where(['status' => 1])->select("nama")->indexBy("id")->column()
                ,['maxlength' => true,'autocomplete' => 'off']) ?>
            </div>
        </div>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
