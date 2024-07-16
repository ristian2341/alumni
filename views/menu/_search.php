<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MenuSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_menu') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'id_header') ?>

    <?= $form->field($model, 'level') ?>

    <?= $form->field($model, 'urutan') ?>

    <?php // echo $form->field($model, 'posisi') ?>

    <?php // echo $form->field($model, 'read') ?>

    <?php // echo $form->field($model, 'create') ?>

    <?php // echo $form->field($model, 'update') ?>

    <?php // echo $form->field($model, 'delete') ?>

    <?php // echo $form->field($model, 'akses_menu') ?>

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
