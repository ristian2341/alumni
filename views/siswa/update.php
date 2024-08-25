<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Siswa $model */

$this->title = Yii::t('app', 'Update Siswa: {name}', [
    'name' => $model->nama,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Siswas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'code' => $model->code]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="siswa-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
