<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\magang\models\JawabanKuisioner $model */

$this->title = 'Update Jawaban Kuisioner: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Jawaban Kuisioners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'code' => $model->code, 'nisn' => $model->nisn]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jawaban-kuisioner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pertanyaan' => $pertanyaan,
    ]) ?>

</div>
