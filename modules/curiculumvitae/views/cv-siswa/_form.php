<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\curiculumvitae\models\CvSiswa $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cv-siswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pendidikan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pengalaman')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kemampuan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
