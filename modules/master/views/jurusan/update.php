<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\master\models\Jurusan $model */

$this->title = Yii::t('app', 'Update Jurusan: {name}', [
    'name' => $model->code,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jurusans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'code' => $model->code]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="jurusan-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
