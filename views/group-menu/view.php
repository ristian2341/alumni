<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\GroupMenu $model */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Group Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<style>
    thead th {
        vertical-align: middle;
        font-size: 12px;
    }

    .btn {
        border-radius: 10px;
        padding: 5px 6px;
    }

    .table {
        width: 100%;
    }

    .table thead tr th {
        padding: 5px 5px;
        color : #dfd1d1;    
    }

    .table tbody tr td {
        background-color: #FFFFFF;
        padding: 3px 0px;
        vertical-align: middle;
    }
</style>

<div class="group-menu-view">

    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['Create'], ['class' => 'btn btn-sm btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            // 'id',
            'nama',
            // 'status',
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

    <table class="table table-striped table-bordered" id="tabel_detail" cellspacing="0" cellpadding="0" >
    <thead>
        <th style='width: 5%;vertical-align: middle;'>No.</th>
        <th style='vertical-align: middle;'>Menu</th>
        <th style='width: 30%;vertical-align: middle;text-align:center;' colspan="4">Action</th>
    </thead>
    <tbody>
        <?php if(!empty($model->groupdetail)): 
            $no = 1;
            foreach ($model->groupdetail as $key => $val) {
        ?>
            <tr>
                <td style='text-align: center;'><?= $no++ ?></td>
                <td><label for="menu_<?= $val->id_menu ?>" >&nbsp;<?= isset($val->menu->nama) ? $val->menu->nama : ''; ?></label></td>
                <td style='text-align: center;'><label>&nbsp;<?= !empty($val->read) ? "View" : "-";  ?></label></td>
                <td style='text-align: center;'><label>&nbsp;<?= !empty($val->create) ? "Create" : "-";  ?></label></td>
                <td style='text-align: center;'><label>&nbsp;<?= !empty($val->update) ? "Update" : "-";  ?></label></td>
                <td style='text-align: center;'><label>&nbsp;<?= !empty($val->delete) ? "Delete" : "-";  ?></label></td>
            </tr>
        <?php
            }
         endif; ?>
    </tbody>
</table>

</div>
