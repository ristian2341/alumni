<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MenuUser $model */

$this->title = 'Create Menu User';
$this->params['breadcrumbs'][] = ['label' => 'Menu Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-user-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
