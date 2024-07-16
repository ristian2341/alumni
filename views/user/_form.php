<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_akun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'device_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fire_base')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_login')->textInput() ?>

    <?= $form->field($model, 'long')->textInput() ?>

    <?= $form->field($model, 'lat')->textInput() ?>

    <?= $form->field($model, 'id_telegram')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'generate_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'developer')->textInput() ?>

    <?= $form->field($model, 'approval')->textInput() ?>

    <?= $form->field($model, 'admin')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'picture')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
