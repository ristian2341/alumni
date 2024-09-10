<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\master\models\MasterKuisioner $model */

$this->title = 'Create Master Kuisioner';
$this->params['breadcrumbs'][] = ['label' => 'Master Kuisioners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-kuisioner-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
