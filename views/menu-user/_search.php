<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MenuUserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="menu-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_user_menu') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'id_menu') ?>

    <?= $form->field($model, 'create') ?>

    <?= $form->field($model, 'update') ?>

    <?php // echo $form->field($model, 'read') ?>

    <?php // echo $form->field($model, 'delete') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
