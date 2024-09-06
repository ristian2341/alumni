<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\magang\models\Magang $model */

$this->title = 'Update Magang: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Magangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'code' => $model->code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="magang-update">

    <?= $this->render('_form', [
        'model' => $model,
        'tbody' => $tbody,
    ]) ?>

</div>
