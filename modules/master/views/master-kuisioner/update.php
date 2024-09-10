<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\master\models\MasterKuisioner $model */

$this->title = 'Update Master Kuisioner: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Master Kuisioners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'code' => $model->code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-kuisioner-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
