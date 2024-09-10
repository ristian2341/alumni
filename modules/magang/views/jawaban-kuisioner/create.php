<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\magang\models\JawabanKuisioner $model */

$this->title = 'Create Jawaban Kuisioner';
$this->params['breadcrumbs'][] = ['label' => 'Jawaban Kuisioners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jawaban-kuisioner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
