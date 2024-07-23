<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MenuUser $model */

$this->title = 'Update Menu User: ' . $model->id_user_menu;
$this->params['breadcrumbs'][] = ['label' => 'Menu Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_user_menu, 'url' => ['view', 'id_user_menu' => $model->id_user_menu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
