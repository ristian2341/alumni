<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <div class="row">
        <div class="col-sm-6">
            <p class="text-left">
                <?= Html::a('Create', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
            </p>
        </div>
        <div class="col-sm-6">
            <p class="text-right">
                <?= Html::a('Update', ['update', 'user_id' => $model->user_id], ['class' => 'btn btn-sm btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'user_id' => $model->user_id], [
                    'class' => 'btn btn-sm btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>
   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            [
                'attribute' =>  'nis',
                'value' => $model->nis,
                'options' => ['style' => 'display : none;'],
            ],
            'username',
            'password',
            'full_name',
            'type_akun',
            'email:email',
            [
                'attribute' => 'approval',
                'value' => ($model->approval == 1) ? 'True' : 'False'
            ],
            [
                'attribute' => 'admin',
                'value' => ($model->admin == 1) ? 'True' : 'False'
            ],
            [
                'attribute' => 'status',
                'value' => ($model->status == 1) ? 'Active' : 'Non Active'
            ],           

            [
                'attribute' => 'created_at',
                'value' => !empty($model->created_at) ? date('d M Y',strtotime($model->created_at)) : '',
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
