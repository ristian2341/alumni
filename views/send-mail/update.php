<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SendMail $model */

$this->title = 'Update Send Mail: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Send Mails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'code' => $model->code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="send-mail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
