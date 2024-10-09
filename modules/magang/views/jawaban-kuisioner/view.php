<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\magang\models\JawabanKuisioner $model */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Jawaban Kuisioners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="jawaban-kuisioner-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Update', ['update', 'code' => $model->code, 'nisn' => $model->nisn], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'code' => $model->code, 'nisn' => $model->nisn], [
            'class' => 'btn btn-sm btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'code',
            'nisn',
            'nama',
           [
                'attribute' => 'created_at',
                'value' => date('d M Y',$model->created_at),
           ],
           [
                'attribute' =>'updated_at',
                'value' => date('d M Y',$model->updated_at),
            ],
        ],
    ]) ?>

    <div class="row">
        <div class="col-sm-6">
            <fieldset>
                <legend>List Pertanyaan</legend>
                <?php if(!empty($model->jawabanDetail)): ?>
                        <?php foreach ($model->jawabanDetail as $key => $data) { ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="hidden" id="JawabanKuisionerDetail-<?= $data['code_jawaban'] ?>-code" class="form-control" name="JawabanKuisionerDetail[<?= $data['code_jawaban'] ?>][code_jawaban][" value='<?= $data['code_jawaban'] ?>' readOnly>
                                    <label for="font-12"><?= isset($data->dataPertanyaan->pertanyaan) ? $data->dataPertanyaan->pertanyaan : ''; ?></label>
                                </div>
                                <div class="col-sm-12">
                                    <textarea class="form-control" readOnly name="JawabanKuisionerDetail[<?= $data['code_jawaban'] ?>][pertanyaan]" id="JawabanKuisionerDetail-<?= $data['code_jawaban'] ?>-code"><?= isset($data['jawaban']) ? $data['jawaban'] :''; ?></textarea>
                                </div>
                            </div>
                                <br>
                        <?php } ?>
                <?php endif; ?>
            </fieldset>
        </div>
    </div>

</div>
