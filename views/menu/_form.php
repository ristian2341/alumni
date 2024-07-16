<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Menu $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="menu-form">
    <?php $form = ActiveForm::begin(); ?>
    div.
    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_header')->textInput() ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <?= $form->field($model, 'urutan')->textInput() ?>

    <?= $form->field($model, 'posisi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'read')->textInput() ?>

    <?= $form->field($model, 'create')->textInput() ?>

    <?= $form->field($model, 'update')->textInput() ?>

    <?= $form->field($model, 'delete')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
