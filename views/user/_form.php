<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'type_akun')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'approval')->textInput() ?>
                <?= $form->field($model, 'admin')->textInput() ?>
            </div>
        </div>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
