<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\magang\models\Magang $model */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Magangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="magang-view">

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        <?= Html::a('Update', ['update', 'code' => $model->code], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'code' => $model->code], [
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
            [
                'attribute' => 'code_perusahaan',
                'value' => isset($model->dataPerusahaan->nama) ? $model->code_perusahaan ." - ". $model->dataPerusahaan->nama : $model->code_perusahaan,
            ],
            'pic',
            [
                'attribute' => 'tgl_mulai',
                'value' => !empty($model->tgl_mulai) ? date('d M Y',strtotime($model->tgl_mulai)) : '',
            ],
            [
                'attribute' => 'tgl_akhir',
                'value' => !empty($model->tgl_akhir) ? date('d M Y',strtotime($model->tgl_akhir)) : '',
            ],
            [
                'attribute' => 'created_at',
                'value' => !empty($model->created_at) ? date('d M Y',$model->created_at) : '',
            ],
            [
                'attribute' =>   'created_by',
                'value' => !empty($model->getCreated()) ? $model->getCreated(): $model->created_by,
            ],
            [
                'attribute' => 'updated_at',
                'value' => !empty($model->updated_at) ? date('d M Y',$model->updated_at) : '',
            ],
            [
                'attribute' => 'updated_by',
                'value' => !empty($model->getUpdated()) ? $model->getUpdated(): $model->updated_by,
            ],
        ],
    ]) ?>
    
    <table class="table table-striped table-bordered" id="tabel_detail" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th style='width: 5%;vertical-align: middle;text-align:center;color : #ced3d9;'>No.</th>
                <th style='width: 18%;vertical-align: middle;text-align:center;color : #ced3d9;'>NISN</th>
                <th style='vertical-align: middle;text-align:left;color : #ced3d9;'>Nama Siswa</th>
                <th style='width: 20%;vertical-align: middle;text-align:center;color : #ced3d9;'>Romble</th>
            </tr>
        </thead>
        <tbody id="tbody">
        <?php if(isset($model->dataDetail)): ?>
            <?php $no = 1; ?>
            <?php foreach ($model->dataDetail as $key => $data): ?>
                <tr data-no='<?= $key ?>'  data-nisn='<?= $data->nisn ?>'>
                    <td><?= $no++; ?></td>
                    <td><?= isset($data['nisn']) ? $data['nisn'] : ''; ?></td>
                    <td><?= isset($data['nama']) ? $data['nama'] : ''; ?></td>
                    <td><?= isset($data['code_jurusan']) ? $data['code_jurusan'] : ''; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

</div>
