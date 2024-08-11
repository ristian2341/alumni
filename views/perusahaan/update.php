<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Perusahaan $model */

$this->title = Yii::t('app', 'Update Perusahaan: {name}', [
    'name' => $model->id_perusahaan,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Perusahaans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_perusahaan, 'url' => ['view', 'id_perusahaan' => $model->id_perusahaan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="perusahaan-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
