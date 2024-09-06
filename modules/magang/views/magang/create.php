<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\magang\models\Magang $model */

$this->title = 'Create Magang';
$this->params['breadcrumbs'][] = ['label' => 'Magangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="magang-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
