<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\magang\models\JawabanKuisioner $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="jawaban-kuisioner-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-4">
            <?= isset($model->code) ? $form->field($model, 'code')->textInput(['maxlength' => true,'readOnly' => true]) : ''; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'nisn')->textInput(['maxlength' => true,'autocomplete' => 'off','readOnly' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'nama')->textInput(['maxlength' => true,'autocomplete' => 'off','readOnly' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'rombel')->textInput(['maxlength' => true,'autocomplete' => 'off','readOnly' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'jurusan')->textInput(['maxlength' => true,'autocomplete' => 'off','readOnly' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <fieldset>
                <legend>Pertanyaan</legend>
                <?php if(!empty($pertanyaan)): ?>
                        <?php foreach ($pertanyaan as $key => $data) { ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="hidden" id="JawabanKuisionerDetail-<?= $data['code'] ?>-code" class="form-control" name="JawabanKuisionerDetail[<?= $data['code'] ?>][code][" value='<?= $data['code'] ?>' readOnly>
                                    <label for="font-12"><?= $data['pertanyaan'] ?></label>
                                </div>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="JawabanKuisionerDetail[<?= $data['code'] ?>][pertanyaan]" id="JawabanKuisionerDetail-<?= $data['code'] ?>-code"></textarea>
                                </div>
                            </div>
                                <br>
                        <?php } ?>
                <?php endif; ?>
            </fieldset>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
