<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Perusahaan $model */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Perusahaans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="perusahaan-view">
    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id_perusahaan' => $model->id_perusahaan], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id_perusahaan' => $model->id_perusahaan], [
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
            'id_perusahaan',
            'nama',
            'alamat',
            'kota',
            'propinsi',
            'email:email',
            'phone',
            'pic1',
            'phone_pic1',
            'email_pic1:email',
            'pic2',
            'phone_pic2',
            'email_pic2:email',
            [
                'attribute' => 'created_at',
                'value' => !empty($model->updated_at) ? date('d M Y',strtotime($model->updated_at)) : '',
            ],
            [
                'attribute' =>   'created_by',
                'value' => !empty($model->getCreated()) ? $model->getCreated(): $model->created_by,
            ],
            [
                'attribute' => 'updated_at',
                'value' => !empty($model->updated_at) ? date('d M Y',strtotime($model->updated_at)) : '',
            ],
            [
                'attribute' => 'updated_by',
                'value' => !empty($model->getUpdated()) ? $model->getUpdated(): $model->updated_by,
            ],
        ],
    ]) ?>

</div>
