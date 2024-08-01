<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Menu $model */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="menu-view">
    <div class="row">
        <p class="text-left">
            <?= Html::a('Create', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
            <?= Html::a('Update', ['update', 'id_menu' => $model->id_menu], ['class' => 'btn btn-sm btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id_menu' => $model->id_menu], [
                'class' => 'btn btn-sm btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_menu',
            'nama',
            [
                'attribute' => 'id_header',
                'value' => function($model){
                    return !empty($model->getHeader()->nama) ? $model->getHeader()->nama : '';
                }
            ],
            'level',
            'urutan',
            'url_menu',
            [
                'attribute' =>  'read',
                'value' => function($model){
                    return ($model->read == 1) ? "True" : 'False';
                }
            ],
            [
                'attribute' =>  'create',
                'value' => function($model){
                    return ($model->create == 1) ? "True" : 'False';
                }
            ],
            [
                'attribute' =>  'update',
                'value' => function($model){
                    return ($model->update == 1) ? "True" : 'False';
                }
            ],
            [
                'attribute' =>  'delete',
                'value' => function($model){
                    return ($model->delete == 1) ? "True" : 'False';
                }
            ],
            
            // 'akses_menu',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
        ],
    ]) ?>

</div>
