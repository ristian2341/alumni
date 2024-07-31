<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Setting $model */

$this->title = $model->id_setting;
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="setting-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_setting' => $model->id_setting], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_setting' => $model->id_setting], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_setting',
            'instansi',
            'alamat_instansi',
            'kabupaten',
            'profinsi',
            'nama_aplikasi',
            'logo',
            'background',
            'icon',
            'email_notif:email',
            'password_email:email',
        ],
    ]) ?>

</div>
