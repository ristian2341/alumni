<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\GroupMenu $model */

$this->title = Yii::t('app', 'Create Group Menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Group Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-menu-create">

    <?= $this->render('_form', [
        'model' => $model,
        'detail' => $detail,
    ]) ?>

</div>
