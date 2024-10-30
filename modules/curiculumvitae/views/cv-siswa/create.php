<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\curiculumvitae\models\CvSiswa $model */

$this->title = 'Create Cv Siswa';
$this->params['breadcrumbs'][] = ['label' => 'Cv Siswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cv-siswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
