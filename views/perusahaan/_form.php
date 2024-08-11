<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Perusahaan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="perusahaan-form">

    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-sm-6">
                <fieldset>
                <legend>Data Perusahaan</legend>
                    <?= $form->field($model, 'nama')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'phone')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?= $form->field($model, 'alamat')->textArea(['maxlength' => true,'autocomplete' => 'off']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'kota')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'propinsi')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-sm-6">
                <fieldset>
                    <legend>Person In Charge</legend>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'pic1')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>   
                            <?= $form->field($model, 'phone_pic1')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            <?= $form->field($model, 'email_pic1')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'pic2')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            <?= $form->field($model, 'phone_pic2')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                            <?= $form->field($model, 'email_pic2')->textInput(['maxlength' => true,'autocomplete' => 'off']) ?>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
