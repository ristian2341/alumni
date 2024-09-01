<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\master\models\Jurusan $model */

$this->title = Yii::t('app', 'Create Jurusan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jurusans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurusan-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
