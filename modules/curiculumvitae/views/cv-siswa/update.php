<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\curiculumvitae\models\CvSiswa $model */

$this->title = 'Update Cv Siswa: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Cv Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'code' => $model->code, 'nik' => $model->nik]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cv-siswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
