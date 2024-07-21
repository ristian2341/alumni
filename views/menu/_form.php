<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Menu;

/** @var yii\web\View $this */
/** @var app\models\Menu $model */
/** @var yii\widgets\ActiveForm $form */
?>
<style>
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
                box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
</style>
<div class="menu-form">
    <?php $form = ActiveForm::begin(); ?>
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Menu</legend>
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'url_menu')->textInput(['maxlength' => true]) ?>
                    </div>        
                    <div class="col-sm-6">
                        <?= 
                            $form->field($model, 'id_header')->widget(Select2::classname(), [
                                'data' =>Menu::find()->where(['url_menu' => "#"])->select("nama")->indexBy("id_menu")->column(),
                                'options' => ['placeholder' => 'Select Header Menu ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                        ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($model, 'level')->textInput() ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($model, 'urutan')->textInput() ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($model, 'read')->checkBox() ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($model, 'create')->checkBox() ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($model, 'update')->checkBox() ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($model, 'delete')->checkBox() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </fieldset>


    <?php ActiveForm::end(); ?>

</div>
