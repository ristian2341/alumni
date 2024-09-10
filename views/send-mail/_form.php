<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SendMail $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="send-mail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bcc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
