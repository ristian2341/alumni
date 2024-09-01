<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\master\models\Jurusan $model */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jurusans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="jurusan-view">

    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'code' => $model->code], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'code' => $model->code], [
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
            'code',
            'nama', 
            [
                'attribute' =>  'status_data',
                'value' => ($model->status_data == 1) ? 'Active': 'Non Active',
            ],
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
