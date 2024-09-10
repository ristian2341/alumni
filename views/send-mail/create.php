<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SendMail $model */

$this->title = 'Create Send Mail';
$this->params['breadcrumbs'][] = ['label' => 'Send Mails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="send-mail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
