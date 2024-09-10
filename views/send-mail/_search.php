<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SendMailSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="send-mail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'type_email') ?>

    <?= $form->field($model, 'subject') ?>

    <?= $form->field($model, 'from') ?>

    <?= $form->field($model, 'to') ?>

    <?php // echo $form->field($model, 'cc') ?>

    <?php // echo $form->field($model, 'bcc') ?>

    <?php // echo $form->field($model, 'body') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
