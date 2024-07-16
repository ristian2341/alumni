<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'nis') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'full_name') ?>

    <?php // echo $form->field($model, 'type_akun') ?>

    <?php // echo $form->field($model, 'device_id') ?>

    <?php // echo $form->field($model, 'fire_base') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'last_login') ?>

    <?php // echo $form->field($model, 'long') ?>

    <?php // echo $form->field($model, 'lat') ?>

    <?php // echo $form->field($model, 'id_telegram') ?>

    <?php // echo $form->field($model, 'generate_code') ?>

    <?php // echo $form->field($model, 'type_user') ?>

    <?php // echo $form->field($model, 'developer') ?>

    <?php // echo $form->field($model, 'approval') ?>

    <?php // echo $form->field($model, 'admin') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'authKey') ?>

    <?php // echo $form->field($model, 'accessToken') ?>

    <?php // echo $form->field($model, 'picture') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
