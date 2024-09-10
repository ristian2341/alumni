<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\magang\models\JawabanKuisioner $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="jawaban-kuisioner-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-4 hide">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'nisn')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <fieldset>
        <legend>Pertanyaan</legend>
        <?php if(!empty($model->dataDetail)): ?>
                <?php foreach ($model->dataDetail as $key => $data) { ?>
                    <table class="">
                    <tr data-no='<?= $key ?>'  data-nisn='<?= $data['nisn'] ?>'>
                        <td><?= $no++; ?><input type="hidden" id="number_<?= $key ?>" class="form-control" name="number[<?= $key ?>]" value='<?= $key ?>' readOnly></td>
                        <td><?= isset($data['nisn']) ? $data['nisn'] : ''; ?><input type="hidden" id="MagangDetail-nisn_<?= $key ?>" class="form-control" name="MagangDetail[<?= $key ?>][nisn]" value='<?= $data['nisn'] ?>'  readOnly></td>
                        <td><?= isset($data['nama']) ? $data['nama'] : ''; ?><input type="hidden" id="MagangDetail-nama_<?= $key ?>" class="form-control" name="MagangDetail[<?= $key ?>][nama]" value='<?= $data['nama'] ?>' readOnly></td>
                        <td><?= isset($data['rombel']) ? $data['rombel'] : ''; ?><input type="hidden" id="MagangDetail-rombel_<?= $key ?>" class="form-control" name="MagangDetail[<?= $key ?>][rombel]"  value='<?= $data['rombel'] ?>' readOnly></td>
                        <td>
                            <button class='btn btn-warning btn-flat btn-sm btn-edit' type='button' title='Edit'><i class='fontello icon-pencil'></i></button>
                            &nbsp;
                            <button class='btn btn-danger btn-flat btn-sm' id='btn-delete' type='button' title='Delete'><i class='fontello icon-trash'></i></button>
                        </td>
                    </table>
                <?php } ?>
        <?php endif; ?>
    </fieldset>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
