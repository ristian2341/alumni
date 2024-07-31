<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Setting $model */

$this->title = 'Update Setting: ' . $model->id_setting;
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_setting, 'url' => ['view', 'id_setting' => $model->id_setting]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="setting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
