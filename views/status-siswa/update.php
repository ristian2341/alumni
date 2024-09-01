<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\StatusSiswa $model */

$this->title = Yii::t('app', 'Update Status Siswa: {name}', [
    'name' => $model->status,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Status Siswas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="status-siswa-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
