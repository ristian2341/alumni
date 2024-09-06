<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\magang\models\MagangSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="magang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'code_perusahaan') ?>

    <?= $form->field($model, 'nama_perusahaan') ?>

    <?= $form->field($model, 'pic') ?>

    <?= $form->field($model, 'tgl_mulai') ?>

    <?php // echo $form->field($model, 'tgl_akhir') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
