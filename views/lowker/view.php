<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Lowker $model */

$this->title = $model->code_lowker;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lowkers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
// print_r($model);die;
?>
<div class="lowker-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'code_lowker' => $model->code_lowker], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'code_lowker' => $model->code_lowker], [
            'class' => 'btn btn-sm btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'code_lowker',
            'tgl_post',
            'tgl_last',
            'lowongan',
            'id_perusahaan',
            'nama_perusahaan',
            'alamat',
            'kabupaten',
            'propinsi',
            'kontak',
            'email:email',
            'requirement:ntext',
            'keterangan:ntext',
            // [
            //     'attribute' => 'created_at',
            //     'value' => !empty($model->created_at) ? date('d M Y',strtotime($model->created_at)) : '',
            // ],
            // [
            //     'attribute' =>   'created_by',
            //     'value' => !empty($model->getCreated()) ? $model->getCreated(): $model->created_by,
            // ],
            // [
            //     'attribute' => 'updated_at',
            //     'value' => !empty($model->updated_at) ? date('d M Y',strtotime($model->updated_at)) : '',
            // ],
            // [
            //     'attribute' => 'updated_by',
            //     'value' => !empty($model->getUpdated()) ? $model->getUpdated(): $model->updated_by,
            // ],
        ],
    ]) ?>

</div>
