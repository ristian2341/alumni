<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\StatusSiswa $model */

$this->title = Yii::t('app', 'Create Status Siswa');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Status Siswas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-siswa-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
