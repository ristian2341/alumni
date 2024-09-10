<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\modules\master\models\Jurusan;

/** @var yii\web\View $this */
/** @var app\modules\master\models\MasterKuisioner $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="master-kuisioner-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'code')->textInput(['maxlength' => true,'readOnly' => true,'autocomplete' => 'off']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <?=  $form->field($model, 'code_jurusan')->widget(Select2::classname(), [
                        'data' => Jurusan::find()->where(['status_data'=>1])->select("nama")->indexBy("code")->column(),
                        'options' => ['placeholder' => 'Select Header Menu ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'type')->dropDownList(['MAGANG' => 'MAGANG','ALUMNI' => 'ALUMNI'],['maxlength' => true,'autocomplete' => 'off']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?= $form->field($model, 'pertanyaan')->textArea(['maxlength' => true,'autocomplete' => 'off']) ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
