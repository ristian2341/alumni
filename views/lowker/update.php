<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Lowker $model */

$this->title = Yii::t('app', 'Update Lowker: {name}', [
    'name' => $model->code_lowker,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lowkers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code_lowker, 'url' => ['view', 'code_lowker' => $model->code_lowker]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="lowker-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
