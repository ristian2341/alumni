<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\master\models\MasterKuisioner $model */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Master Kuisioners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="master-kuisioner-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'code' => $model->code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'code' => $model->code], [
            'class' => 'btn btn-danger',
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
                'attribute' => 'code_jurusan',
                'value' => isset($model->MasterJurusan->nama) ? $model->MasterJurusan->nama : $model->code_jurusan,
            ],
            'type',
            'pertanyaan',
            [
                'attribute' => 'created_at',
                'value' => !empty($model->updated_at) ? date('d M Y',$model->updated_at) : '',
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

</div>
